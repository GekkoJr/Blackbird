<?php

namespace App\Livewire\AppComponents;

use App\Models\GlobalMessage;
use Livewire\Attributes\On;
use Livewire\Component;

class MainView extends Component
{
    public $channel;

    // contains both me
    public $messages = [];

    public function mount()
    {
        $this->channel = 'placeholder';
        array_push($this->messages, $this->channel);
    }

    //this swappes between chat and friends view
    #[On('swap')]
    public function swapInterface($mode, $channel)
    {
        if ($mode === 'channel')
        {
            $this->channel = $channel;

            if ($channel === 'global')
            {
                $this->messages = GlobalMessage::latest()->take(10)->get();

            }
        }
    }

    #[On('echo:{channel},Message')]
    public function updateMessages($event)
    {

    }

    public function render()
    {
        return view('livewire.app-components.main-view');
    }
}
