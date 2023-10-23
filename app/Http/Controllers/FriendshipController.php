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

        foreach ($currentUser->getOtherUsersIdFromFriends() as $userId) {
            if($currentUser->id === $userId) {
                return back()->withErrors([
                    'error' => 'Are you really that lonely'
                ]);
            }
            if($userId === $userToAdd->id) {
                return back()->withErrors([
                    'error' => 'you are already friends'
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
