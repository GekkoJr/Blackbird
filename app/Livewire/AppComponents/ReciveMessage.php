<?php

namespace App\Livewire\AppComponents;

use App\Models\GlobalMessage;
use Carbon\Carbon;
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
        if ($this->channel !== 'placeholder') {
            if ($this->channel == 'global') {
                // loads the messages (since it is global no need to find spesific channel)
                $this->messages = GlobalMessage::latest('created_at')->take(20)->get()->reverse()->toArray();
                $this->dateFixer();
            }
        }
    }

    // dont know if this is needed for it to work
    public function dateFixer()
    {
        foreach ($this->messages as $message) {
            $message['created_at'] = new Carbon($message['created_at']);
            $message['created_at']->format('d m H i');
        }
    }

    public function render()
    {
        return view('livewire.app-components.recive-message');
    }
}
