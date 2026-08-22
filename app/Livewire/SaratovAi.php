<?php

namespace App\Livewire;

use App\DTOs\StructuredResponse\SaratovModelStructuredResponseDTO;
use App\Jobs\PromptAgent;
use App\Models\User;
use App\Services\ModelConversationService;
use App\Services\StructuredResponseToModelService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Laravel\Ai\Messages\MessageRole;
use Livewire\Component;

class SaratovAi extends Component
{
    public bool $authorized = false;

    const string HELLO_MESSAGE = 'Привет! Я Саратов, ваш AI-гид!';

    public bool $createsNewConversation = false;

    public array $chatMessages = [];

    public string $prompt = '';

    public bool $isWaitingForResponse = false;

    protected ModelConversationService $modelConversationService;

    protected StructuredResponseToModelService $structuredResponseToModelService;

    public function boot(ModelConversationService $modelConversationService, StructuredResponseToModelService $structuredResponseToModelService)
    {
        $this->modelConversationService = $modelConversationService;
        $this->structuredResponseToModelService = $structuredResponseToModelService;
    }

    public function mount()
    {
        $user = auth()->user();
        $this->authorized = $user != null;
        if (! $this->authorized) {
            $this->addMessageFromModel('Для использования бота необходимо авторизоваться в аккаунте');
        } else {
            $this->loadMessages($user);
        }
    }

    public function clearMessages() {
        $this->chatMessages = [];
    }

    public function loadMessages(User $user) {
        $userMessages = $this->modelConversationService->messagesFromCurrentConversation($user);
        $this->clearMessages();
        $this->addHelloMessageFromModel();
        if (count($userMessages) > 0) {
            foreach ($userMessages as $message) {
                if ($message->role == MessageRole::User) {
                    $this->addMessageFromUser($message->content);
                } else {
                    try {
                        $dto = SaratovModelStructuredResponseDTO::fromJson($message->content);
                        $this->addMessageFromModel($dto);
                    } catch (Exception $ex) {
                        Log::warning('Unable to parse content of message as SaratovModelStructuredResponseDTO', [
                            'message.content' => $message?->content,
                            'reasosn' => $ex->getMessage(),
                        ]);
                        $this->addMessageFromModel($message->content);
                    }
                }
            }
        }
    }

    public function addHelloMessageFromModel() {
        $this->addMessageFromModel(self::HELLO_MESSAGE);
    }

    public function switchNewConversationMode() {
        $this->createsNewConversation = !$this->createsNewConversation;
        if ($this->createsNewConversation) {
            $this->clearMessages();
            $this->addHelloMessageFromModel();
        } else {
            $this->loadMessages(auth()->user());
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

        PromptAgent::dispatch(auth()->user(), $this->prompt, $this->createsNewConversation);

        $this->isWaitingForResponse = true;
        $this->createsNewConversation = false;
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
                    $this->addMessageFromModel($dto->response);
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

    public function addMessageFromModel(SaratovModelStructuredResponseDTO|string $message)
    {
        if (is_string($message)) {
            $this->chatMessages[] = [
                'fromBot' => true,
                'text' => $message,
                'entities' => new Collection,
            ];
        } else {
            $text = $message?->response ?? '';
            $entities = $message?->response_entities?->map(fn ($entity) => $this->structuredResponseToModelService->toDatabaseModel($entity->entity_id, $entity->entity_type, ['attachments']))->filter(fn ($entity) => $entity !== null) ?? new Collection;
            $this->chatMessages[] = [
                'fromBot' => true,
                'text' => $text,
                'entities' => $entities,
            ];
        }
    }

    public function render()
    {
        return view('livewire.saratov-ai');
    }
}
