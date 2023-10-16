<?php

namespace App\Livewire\AppComponents;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class SendMessage extends Component
{
    public string $message;

    public string $channel;

    public function mount($channel)
    {
        $this->channel = $channel;
    }

    #[On('swap')]
    public function swapChannel($channel = null)
    {
        // stopps from crashing when in friends mode
        if (! isset($channel)) {
            $channel = 'placeholder';
        }

        $this->channel = $channel;
    }

    public function sendMessage()
    {
        if ($this->channel == 'global') {
            $from = Auth::user()->username;
            // sends chat via chatcontroller
            app('App\Http\Controllers\ChatController')->globalChat($this->message, $from);
        }

        $this->message = '';
    }

    public function render()
    {
        return view('livewire.app-components.send-message');
    }
}
