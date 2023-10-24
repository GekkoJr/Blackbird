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
        $from = Auth::user()->username;
        if ($this->channel == 'global') {

            // sends chat via chatcontroller
            app('App\Http\Controllers\ChatController')->globalChat($this->message, $from);
        } else {
            app('App\Http\Controllers\ChatController')->privateChat($this->message, $from, $this->channel);
        }

        $this->message = '';
    }

    public function render()
    {
        return view('livewire.app-components.send-message');
    }
}
