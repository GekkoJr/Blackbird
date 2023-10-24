<?php

namespace App\Livewire\AppComponents\FriendsComponents;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Pending extends Component
{
    public $pendingList = [];

    public $userId;

    public function mount() {
        $this->pendingList = Auth::user()->getPendingFriendshipsUsers();

        $this->userId = Auth::user();
    }

    public function render()
    {
        return view('livewire.app-components.friends-components.pending');
    }
}
