<?php

namespace App\Jobs;

use App\Ai\Agents\SaratovAiModel;
use App\DTOs\ModelPendingResponseDTO;
use App\Models\User;
use App\Services\ModelConversationService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Laravel\Ai\Responses\StructuredAgentResponse;

class PromptAgent implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public User $user,
        public string $message,
        public $promptable = SaratovAiModel::class,
    ) {
        $this->onQueue('chat_bot');
    }

    /**
     * Execute the job.
     */
    public function handle(ModelConversationService $modelConversationService): void
    {
        $dto = null;
        try {
            $response = $modelConversationService->promptModelForUser($this->user, $this->message);
            $message = null;
            if ($response instanceof StructuredAgentResponse) {
                $message = $response->toArray();
            } else {
                $message = $response->text;
            }
            $dto = ModelPendingResponseDTO::fromArray([
                'userId' => $this->user->id,
                'ok' => true,
                'response' => $message,
            ]);
        } catch (Exception $ex) {
            $dto = ModelPendingResponseDTO::fromArray([
                'userId' => $this->user->id,
                'ok' => false,
                'errorMessage' => $ex->getMessage(),
            ]);
            Log::error('Unable to prompt model: '.$ex->getMessage(), ['user_id' => $this->user->id]);
        } finally {
            $modelConversationService->writeModelResultsToCache($dto);
        }

    }
}
