<?php

namespace App\Http\Controllers;

use App\Events\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(request $request) {
        event(new Message($request->input('message')));
    }
}
