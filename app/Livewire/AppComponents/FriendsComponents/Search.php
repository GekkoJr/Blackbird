<?php

namespace App\Livewire\AppComponents\FriendsComponents;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Search extends Component
{
    public string $search;

    private $users;

    public array $errors = [];

    public function mount()
    {
        // this stopps the component crashing beacause of no input + really long and random so no users show up
        $this->search = '';
        // TODO: make this not cursed
    }

    public function getUsers()
    {
        if (Str::length($this->search >= 3)) {
            $this->users = User::where('username', 'LIKE', '%' . $this->search . '%')->get();
        }
    }

    public function sendRequest($username)
    {
        try {
            app('App\Http\Controllers\FriendshipController')->addFriend($username);
        } catch (ValidationException $e) {
            $this->errors = $e->errors();
            $this->render();
        }

    }

    public function render()
    {
        $this->getUsers();

        return view('livewire.app-components.friends-components.search', [
            'users' => $this->users
        ]);
    }
}
