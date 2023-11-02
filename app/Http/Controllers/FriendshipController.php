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
        if (!User::where('username', $request->username)->exists()) {
            return back()->withErrors([
                'error' => 'User not found'
            ]);
        }

        $currentUser = Auth::user();
        $userToAdd = User::where('username', $request->username)->first();

        if ($currentUser->id === $userToAdd->id) {
            return back()->withErrors([
                'error' => 'Are you really that lonely'
            ]);
        }

        foreach ($currentUser->getOtherUsersFromFriends() as $user) {

            if ($user->id === $userToAdd->id) {
                return back()->withErrors([
                    'error' => 'you are already friends'
                ]);
            }
        }

        $friendship = new Friendship;
        $friendship->pending = $currentUser->id;
        $friendship->save();

        $currentUser->friendships()->attach($friendship->id);
        $userToAdd->friendships()->attach($friendship->id);

        // not an error message but inertiajs makes handing over errors to easy
        return back()->withErrors([
            'success' => 'Friendrequest sendt',
        ]);
    }

    public function allFriends()
    {
        if (!Auth::check()) {
            return to_route('login');
        }

        return Auth::user()->getFriendshipsAndChannels();
    }

    public function getPending()
    {
        if (!Auth::check()) {
            return to_route('login');
        }

        return Auth::user()->getPendingFriendshipsUsers();
    }

    public function acceptFriend(Request $request)
    {
        $friendshipId = $request->user;
        $canAdd = false;

        $friendship = Friendship::find($friendshipId);

        if ($friendship->pending === Auth::user()->id) {
            return back()->withErrors([
                'accept' => 'You sent the request'
            ]);
        }

        foreach ($friendship->users as $user) {
            if ($user->id === Auth::id()) {
                $canAdd = true;
            }
        }

        if ($canAdd) {
            $friendship->pending = null;
            $friendship->save();
            return to_route('home');
        }

        return back()->withErrors([
            'accept' => 'You are not authorized to do this'
        ]);
    }
}
