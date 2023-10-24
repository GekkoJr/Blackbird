<?php

namespace App\Http\Controllers;

use App\Events\GlobalMessages;
use App\Events\Message;
use App\Models\GlobalMessage;

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

    public function privateChat($message, $from, $channel)
    {
        if ($message !== '') {
            $time = time();

            event(new GlobalMessages($message, $from, $time, $channel));
        }

    }
}
