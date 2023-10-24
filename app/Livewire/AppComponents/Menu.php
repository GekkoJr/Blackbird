<?php

namespace App\Livewire\AppComponents;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Menu extends Component
{
    public array $friendsAndGroups = [];

    public function mount()
    {
        $this->friendsAndGroups = Auth::user()->getFriendshipsAndChannels() ?? [':(', 'no friends'];
    }

    public function global()
    {
        $this->dispatch('swap', mode: 'channel', channel: 'global');
    }

    public function friends()
    {
        // when channel is not in use, use placeholder if not error :(
        $this->dispatch('swap', mode: 'friends');
    }

    public function swapChannel($channel)
    {
        $this->dispatch('swap', mode: 'channel', channel: $channel);
    }

    public function render()
    {
        return view('livewire.app-components.menu');
    }
}
