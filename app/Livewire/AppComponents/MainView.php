<?php

namespace App\Livewire\AppComponents;

use Livewire\Attributes\On;
use Livewire\Component;

class MainView extends Component
{
    public $channel;

    public $messages = [];


    #[On('swap')]
    public function swapInterface($mode, $channel)
    {
        if($mode === 'channel')
        {
            $this->channel = $channel;

            if($channel === 'global')
            {

            }
        }
    }

    #[On('echo:{channel},Message')]
    public function updateMessages()
    {

    }

    public function render()
    {
        return view('livewire.app-components.main-view');
    }
}
