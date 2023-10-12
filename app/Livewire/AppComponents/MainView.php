<?php

namespace App\Livewire\AppComponents;


use Livewire\Attributes\On;
use Livewire\Component;

class MainView extends Component
{
    public $channel;

    public $mode;

    public function mount()
    {
        $this->channel = 'placeholder';
        $this->mode = 'friends';
    }

    //this swappes between chat and friends view
    #[On('swap')]
    public function swapInterface($mode, $channel = null)
    {
        if ($mode === 'channel')
        {
            $this->channel = $channel;
            $this->mode = 'channel';
        }
        if($mode === 'friends') {
            // stops listening for events
            $this->channel = 'placeholder';
            $this->mode = 'friends';
        }
    }


    public function render()
    {
        return view('livewire.app-components.main-view');
    }
}
