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
        $currentUser = Auth::user();
        $userToAdd   = User::where('username', $username)->first();

        if(!$userToAdd) {
            return back()->withErrors([
                'error' => 'User not found',
            ]);
        }

        foreach ($currentUser->friendships as $friend){
            $friend->users()->where('user_id', $userToAdd->id)->exists();
            if($friend) {
                return back()->withErrors([
                   'error' => 'Already Friends'
                ]);
            }
        }

        $friendship =  new Friendship;
        $friendship->pending = $currentUser->id;
        $friendship->save();

        $currentUser->friendships()->attach($friendship->id);
        $userToAdd->friendships()->attach($friendship->id);

        return back()->with([
            'succes' => 'Friendrequest sendt',
        ]);
    }
}
