<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $from = Auth::user()->username;
        $createdAt = time();

        $message = new Message;
        $message->fromUser = $from;
        $message->message = $request->message;
        $message->created_at_unix = $createdAt;
        $message->channel = $request->channel;
        $message->save();

        SendMessage::dispatch($request->message, $from, $createdAt, $request->channel, $message->id);


    }
}
