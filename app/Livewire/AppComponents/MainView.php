<?php

namespace App\Livewire\AppComponents;


use Livewire\Attributes\On;
use Livewire\Component;

class MainView extends Component
{
    public $channel;

    public $event;

    public function mount()
    {
        $this->channel = 'placeholder';
    }

    //this swappes between chat and friends view
    #[On('swap')]
    public function swapInterface($mode, $channel)
    {
        if ($mode === 'channel')
        {
            $this->channel = $channel;
        }
    }


    public function render()
    {
        return view('livewire.app-components.main-view');
    }
}
