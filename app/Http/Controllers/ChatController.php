<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Events\Message;
use App\Models\GlobalMessage;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    public function globalChat($message, $from)
    {
        if ($message !== '') {
            $globalMessage = new GlobalMessage;
            $globalMessage->message = $message;
            $globalMessage->fromUser = $from;
            $globalMessage->save();

            event(new Message($message, $from, $globalMessage->created_at));
        }

    }

    public function sendMessage(Request $request) {
        $request->validate([
            'message' => 'required'
        ]);

        if($request->channel === 'global') {

        }


    }

    public function privateChat($message, $from, $channel)
    {
        if ($message !== '') {
            $time = time();

            event(new Message($message, $from, $time, $channel));
        }

    }
}
