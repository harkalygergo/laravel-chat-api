<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MessageController extends Controller
{
    public function send(Request $request, User $recipient)
    {
        $request->validate(['content' => 'required|string']);

        if (!$request->user()->friends->contains($recipient)) {
            return response()->json(['message' => 'Not friends'], 403);
        }

        $message = Message::create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $recipient->id,
            'content' => $request->input('content'),
        ]);

        return response()->json($message);
    }

    public function conversation(User $user, Request $request)
    {
        $authUser = $request->user();

        if (!$authUser->friends->contains($user)) {
            return response()->json(['message' => 'Not friends'], 403);
        }

        $messages = Message::where(function ($q) use ($authUser, $user) {
            $q->where('sender_id', $authUser->id)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($authUser, $user) {
            $q->where('sender_id', $user->id)
                ->where('receiver_id', $authUser->id);
        })->orderBy('created_at', 'desc')->paginate(20);

        return response()->json($messages);
    }
}
