<?php

namespace App\Livewire;

use Livewire\Component;

class SaratovAi extends Component
{
    public bool $authorized = false;

    /**
     * @var array[array]
     */
    public array $chatMessages = [];

    public string $prompt = '';

    public function mount()
    {
        $this->authorized = auth()->user() != null;
        if (! $this->authorized) {
            $this->replyToUser('Для использования бота необходимо авторизоваться в аккаунте');
        } else {
            $this->replyToUser('Привет! Я Саратов, ваш AI-гид!');
        }
    }

    public function postMessage()
    {
        if (empty($this->prompt)) {
            $this->addError('prompt', 'Запрос не должен быть пустым');

            return;
        }

        $this->resetErrorBag();

        $message = [
            'fromBot' => false,
            'text' => $this->prompt,
        ];
        $botReply = [
            'fromBot' => true,
            'text' => $this->prompt,
        ];
        $this->prompt = '';

        $this->chatMessages[] = $message;
        $this->chatMessages[] = $botReply;
    }

    public function replyToUser(string $text)
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
