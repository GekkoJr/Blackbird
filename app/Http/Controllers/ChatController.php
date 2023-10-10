<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Models\GlobalMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function globalChat($message, $from)
    {
        $globalMessage = new GlobalMessage;
        $globalMessage->message  = $message;
        $globalMessage->fromUser = $from;
        $globalMessage->save();

        event(new Message($message, $from));
    }
}
