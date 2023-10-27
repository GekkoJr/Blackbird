<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    //
    public function addFriend(Request $request)
    {
        if(!User::where('username', $request->username)->exists()) {
            return back()->withErrors([
                'error' => 'User not found'
            ]);
        }

        $currentUser = Auth::user();
        $userToAdd   = User::where('username', $request->username)->first();



        foreach ($currentUser->getOtherUsersFromFriends() as $userId) {
            if($currentUser->id === $userId->id) {
                return back()->withErrors([
                    'error' => 'Are you really that lonely'
                ]);
            }
            if($userId->id === $userToAdd->id) {
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

        // not an error message but inertiajs makes handing over errors to easy
        return back()->withErrors([
            'success' => 'Friendrequest sendt',
        ]);
    }

    public function allFriends() {
        if(!Auth::check()) {
            return to_route('login');
        }

        return Auth::user()->getFriendshipsAndChannels();
    }

    public function getPending() {
        if(!Auth::check()) {
            return to_route('login');
        }

        return Auth::user()->getPendingFriendshipsUsers();
    }
}
