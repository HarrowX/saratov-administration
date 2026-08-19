<?php

namespace App\Livewire;

use App\Jobs\PromptAgent;
use App\Services\ModelConversationService;
use Laravel\Ai\Messages\MessageRole;
use Livewire\Component;

class SaratovAi extends Component
{
    public bool $authorized = false;

    public array $chatMessages = [];

    public string $prompt = '';

    public bool $isWaitingForResponse = false;

    protected ModelConversationService $modelConversationService;

    public function boot(ModelConversationService $modelConversationService)
    {
        $this->modelConversationService = $modelConversationService;
    }

    public function mount()
    {
        $user = auth()->user();
        $this->authorized = $user != null;
        if (! $this->authorized) {
            $this->addMessageFromModel('Для использования бота необходимо авторизоваться в аккаунте');
        } else {
            $userMessages = $this->modelConversationService->messagesFromCurrentConversation($user);
            if (count($userMessages) > 0) {
                foreach ($userMessages as $message) {
                    if ($message->role == MessageRole::User) {
                        $this->addMessageFromUser($message->content);
                    } else {
                        $this->addMessageFromModel($message->content);
                    }
                }
            } else {
                $this->addMessageFromModel('Привет! Я Саратов, ваш AI-гид!');
            }
        }
    }

    public function postMessage()
    {
        if (! $this->authorized) {
            $this->addError('prompt', 'Авторизуйтесь для использования чата');

            return;
        }
        if ($this->isWaitingForResponse) {
            $this->addError('prompt', 'Сообщение в процессе обработки');
            
            return;
        }
        $this->prompt = trim($this->prompt);
        $maxMessageLength = $this->modelConversationService->maxMessageLength();

        $this->validate([
            'prompt' => ['required', 'string', 'min:0', 'max:'.$maxMessageLength],
        ], [
            'prompt.max' => 'Длинна сообщения не должна превышать '.$maxMessageLength.' символов',
            'prompt.required' => 'Сообщение не может быть пустым',
        ]);

        $this->resetErrorBag();
        $this->addMessageFromUser($this->prompt);

        PromptAgent::dispatch(auth()->user(), $this->prompt);

        $this->isWaitingForResponse = true;
        $this->prompt = '';
    }

    public function pollModelResponse()
    {
        if (! $this->authorized) {
            return;
        }
        if (! $this->isWaitingForResponse) {
            return;
        }

        $user = auth()->user();
        if ($user) {
            $exists = false;
            $dto = $this->modelConversationService->pullModelResultsFromCache($user, $exists);
            if ($exists) {
                if ($dto->ok) {
                    $this->addMessageFromModel($dto->message);
                    $this->resetErrorBag();
                } else {
                    $this->addError('prompt', $dto->errorMessage);
                }
                $this->isWaitingForResponse = false;
            }
        }
    }

    public function addMessageFromUser(string $text)
    {
        $this->chatMessages[] = [
            'fromBot' => false,
            'text' => $text,
        ];
    }

    public function addMessageFromModel(string $text)
    {
        $this->chatMessages[] = [
            'fromBot' => true,
            'text' => $text,
        ];
    }

    public function render()
    {
        return view('livewire.saratov-ai');
    }
}
