<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function globalChat($message, $from)
    {
        if ($message !== '') {
            $globalMessage = new Message;
            $globalMessage->message = $message;
            $globalMessage->fromUser = $from;
            $globalMessage->save();

            // event(new Message($message, $from, $globalMessage->created_at));
        }

    }

    public function sendMessage(Request $request) {
        $request->validate([
            'message' => 'required'
        ]);

        $from = Auth::user()->username;
        $createdAt = time();

        event(new Message($request->message, $from,$createdAt, $request->channel));

         //Message::dispatch($request->message, $from, $createdAt, $request->channel );
    }
}
