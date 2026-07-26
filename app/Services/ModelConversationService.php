<?php

namespace App\Services;

use App\Ai\Agents\SaratovAiModel;
use App\Models\User;
use Laravel\Ai\Concerns\RemembersConversations;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Promptable;

class ModelConversationService
{
    public function __construct(
        protected int $maxUserMessageLength,
    ) {}

    public function maxMessageLength(): int
    {
        return $this->maxUserMessageLength;
    }

    /**
     * @template T of Promptable|Agent|Conversational|RemembersConversations
     *
     * @param  T  $promptable
     * @return T
     */
    protected function getOrCreateConversationWithModel(User $user, bool $reset = false, $promptable = SaratovAiModel::class)
    {
        $hasConversations = $user->conversations()->exists();
        if (! $reset && $hasConversations) {
            return $promptable::make()->continueLastConversation($user);
        } else {
            return $promptable::make()->forUser($user);
        }
    }

    /**
     * @template T of Promptable|Agent|Conversational|RemembersConversations
     *
     * @param  T  $promptable
     */
    public function promptModelForUser(User $user, string $userMessage, $promptable = SaratovAiModel::class): string
    {
        $agent = $this->getOrCreateConversationWithModel($user, promptable: $promptable);
        $response = $agent->prompt($userMessage);

        return $response->text;
    }

    /**
     * @template T of Promptable|Agent|Conversational|RemembersConversations
     *
     * @param  T  $promptable
     */
    public function resetConversationForUser(User $user, $promptable = SaratovAiModel::class)
    {
        // TODO: not working
        $this->getOrCreateConversationWithModel($user, reset: true, promptable: $promptable);
    }

    /**
     * @template T of Promptable|Agent|Conversational|RemembersConversations
     *
     * @param  T  $promptable
     */
    public function messagesFromCurrentConversation(User $user, $promptable = SaratovAiModel::class): iterable
    {
        return $promptable::make()->continueLastConversation($user)->messages();
    }
}
