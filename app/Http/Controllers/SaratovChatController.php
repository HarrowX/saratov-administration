<?php

namespace App\Http\Controllers;

use App\Services\ModelConversationService;
use Illuminate\Http\Request;

class SaratovChatController extends Controller
{
    public function __construct(
        protected ModelConversationService $modelConversationService,
    ) {}

    public function processUserMessage(Request $request)
    {
        $maxMessageLength = $this->modelConversationService->maxMessageLength();
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:'.$maxMessageLength],
        ], [
            'message.max' => 'Длинна сообщения не должна превышать '.$maxMessageLength.' символов',
        ]);
        $message = $validated['message'];

        $user = auth()->user();

        $response = $this->modelConversationService->promptModelForUser($user, $message);

        return response()->json([
            'text' => $response,
        ], 200);
    }

    public function getAllMessages(Request $request)
    {
        $user = auth()->user();
        $messages = $this->modelConversationService->messagesFromCurrentConversation($user);

        return response()->json($messages, 200);
    }

    public function resetDialog(Request $request)
    {
        $user = auth()->user();
        $this->modelConversationService->resetConversationForUser($user);

        return response()->json([], 204);
    }
}
