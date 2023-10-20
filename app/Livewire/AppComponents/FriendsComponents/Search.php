<?php

namespace App\Livewire\AppComponents\FriendsComponents;

use Livewire\Component;

class Search extends Component
{
    public string $search;

    public function update()
    {

    }

    public function render()
    {
        return view('livewire.app-components.friends-components.search');
    }
}
