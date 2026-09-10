<?php

namespace App\Http\Controllers;

use App\DTOs\StructuredResponse\SaratovModelStructuredResponseDTO;
use App\Services\ModelConversationService;
use Illuminate\Http\Request;
use Laravel\Ai\Responses\StructuredAgentResponse;

class SaratovChatController extends Controller
{
    public function __construct(
        protected ModelConversationService $modelConversationService,
    ) {}

    public function processUserMessage(Request $request)
    {
        $maxMessageLength = $this->modelConversationService->maxMessageLength();
        $request->validate([
            'message' => ['required', 'string', 'max:'.$maxMessageLength],
            'start_new_dialog' => ['sometimes', 'nullable', 'boolean'],
        ], [
            'message.max' => 'Длинна сообщения не должна превышать '.$maxMessageLength.' символов',
        ]);
        $message = $request->input('message');
        $startNewDialog = $request->boolean('start_new_dialog');

        $user = auth()->user();

        $response = $this->modelConversationService->promptModelForUser($user, $message, startNew: $startNewDialog);

        $dto = null;
        if ($response instanceof StructuredAgentResponse) {
            $dto = SaratovModelStructuredResponseDTO::fromArray($response->toArray());
        } else {
            $dto = SaratovModelStructuredResponseDTO::fromArray([
                'response' => $response->text,
                'response_entities' => [],
            ]);
        }

        return response()->json($dto->toArray(), 200);
    }

    public function getAllMessages(Request $request)
    {
        $user = auth()->user();
        $messages = $this->modelConversationService->messagesFromCurrentConversation($user);

        return response()->json($messages, 200);
    }
}
