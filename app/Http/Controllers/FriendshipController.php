<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    //
    public function addFriend($username)
    {
        if(!User::where('username', $username)) {
            return back();
        }

        $currentUser = Auth::user();
        $userToAdd   = User::where('username', $username)->get();

        $friendship =  new Friendship;
        $friendship->pending = $currentUser->id;
        $friendship->save();

        $currentUser->friendships()->attach($friendship->id);
        $userToAdd->friendships()->attach($friendship->id);

        return back();
    }
}
