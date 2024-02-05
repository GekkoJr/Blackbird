<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required'
        ]);

        // get the current id
        $from = Auth::id();
        $createdAt = time();

        $message = new Message;
        $message->user_id = $from;
        $message->message = $request->message;
        $message->created_at_unix = $createdAt;
        $message->channel = $request->channel;
        $message->save();

        // triggers the SendMessage Event
        SendMessage::dispatch($request->message, [Auth::user()->username], $createdAt, $request->channel, $message->id);
    }
    public function getMessages(string $channel, int $skip)
    {
        return \App\Models\Message::with('user:id,username')->latest()->where('channel', $channel)->skip($skip)->take(50)->get()->toJson();
    }

    public function userImg($name)
    {
        $filename = storage_path() . "/app/userIcon/" . $name . ".jpg";
        if (file_exists($filename)) {
            return response()->file($filename);
        }

        return response()->file(resource_path() . "/img/defaultIcon.jpg");
    }

    public function updateImg(Request $request)
    {
        if (!Storage::exists('userIcon')) {
            Storage::makeDirectory('userIcon');
        }

        $request->validate([
            'avatar' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $name = Auth::id() . "." . $request->avatar->extension();

        $request->file('avatar')->storeAs("/userIcon/", $name);

        return back();
    }
}
