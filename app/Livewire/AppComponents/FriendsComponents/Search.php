<?php

namespace App\Livewire\AppComponents\FriendsComponents;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;

class Search extends Component
{
    public string $search;

    private $users;

    public function mount()
    {
        // this stopps the component crashing beacause of no input + really long and random so no users show up
        $this->search = '';
        // TODO: make this not cursed
    }

    public function getUsers() {
        if(Str::length($this->search >= 3))
            $this->users = User::where('username', 'LIKE', '%' . $this->search . '%')->get();
    }

    public function sendRequest($username)
    {
        app('App\Http\Controllers\FriendshipController')->addFriend($username);
    }

    public function render()
    {
        $this->getUsers();

        return view('livewire.app-components.friends-components.search', [
            'users' => $this->users
        ]);
    }
}
