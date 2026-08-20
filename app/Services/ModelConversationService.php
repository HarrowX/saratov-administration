<?php

namespace App\Services;

use App\Ai\Agents\SaratovAiModel;
use App\DTOs\ModelPendingResponseDTO;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Laravel\Ai\Concerns\RemembersConversations;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Models\ConversationMessage;
use Laravel\Ai\Promptable;
use Laravel\Ai\Responses\AgentResponse;
use Laravel\Ai\Responses\StructuredAgentResponse;

class ModelConversationService
{
    public function __construct(
        protected int $maxUserMessageLength,
    ) {}

    public function maxMessageLength(): int
    {
        return $this->maxUserMessageLength;
    }

    protected const responsePrefix = 'user-model-response-content-';

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
    public function promptModelForUser(User $user, string $userMessage, $promptable = SaratovAiModel::class): AgentResponse|StructuredAgentResponse
    {
        $agent = $this->getOrCreateConversationWithModel($user, promptable: $promptable);
        $response = $agent->prompt($userMessage);

        return $response;
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
     * @return ConversationMessage[]
     */
    public function messagesFromCurrentConversation(User $user, $promptable = SaratovAiModel::class): iterable
    {
        return $promptable::make()->continueLastConversation($user)->messages();
    }

    public function writeModelResultsToCache(ModelPendingResponseDTO $dto)
    {
        Cache::set(self::responsePrefix.$dto->userId, $dto->toJson(), 30);
    }

    public function pullModelResultsFromCache(User $user, bool &$exists): ?ModelPendingResponseDTO
    {
        $exists = Cache::has(self::responsePrefix.$user->id);
        if (! $exists) {
            return null;
        }

        $response = Cache::pull(self::responsePrefix.$user->id);

        return ModelPendingResponseDTO::fromJson($response);
    }
}
