<?php

namespace App\Livewire\AppComponents;

use App\Models\GlobalMessage;
use Livewire\Attributes\On;
use Livewire\Component;

class ReciveMessage extends Component
{
    public array $messages = [];

    public string $channel;

    public function mount($channel)
    {
        $this->channel = $channel;
        $this->load();
    }

    // all message event should have a broadcastAs message and use a correct channel
    #[On('echo:{channel},Message')]
    public function updateMessages($event)
    {
        // yes this is just here to rename it, it is not the best, but it works
        $event['fromUser'] = $event['from'];
        array_push($this->messages, $event);
    }

    public function load()
    {
        if($this->channel !== 'placeholder')
        {
            if($this->channel == 'global')
            {
                $this->messages = GlobalMessage::latest()->take(10)->get()->toArray();
            }
        }
    }

    public function render()
    {
        return view('livewire.app-components.recive-message');
    }
}
