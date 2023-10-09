<?php

namespace App\Livewire\AppComponents;

use Livewire\Component;

class Menu extends Component
{
    public function global()
    {
        $this->dispatch('swap', mode: 'channel', channel: 'global');
    }

    public function render()
    {
        return view('livewire.app-components.menu');
    }
}
