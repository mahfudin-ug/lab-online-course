<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\ChatStoredEvent;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index()
    {
        $chats = Chat::with('user')->orderBy('created_at', 'desc')->take(10)->get();

        return response()->json($chats, 200);
    }

    public function store(Request $request)
    {
        $chat = Chat::create([
            'subject' => $request->subject,
            'user_id' => auth()->user()->id
        ]);

        broadcast(new ChatStoredEvent($chat))->toOthers();

        return response()->json($chat, 201);
    }
}
