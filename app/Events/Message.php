<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    // this is for global chat ONLY
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;

    public string $from;

    // time
    public $created_at;

    public function __construct($message, $from, $time)
    {
        $this->message = $message;
        $this->from = $from;
        $this->created_at = $time;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('global'),
        ];
    }
}
