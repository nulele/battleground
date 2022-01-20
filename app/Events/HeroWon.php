<?php

namespace App\Events;

use App\Models\Hero;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HeroWon
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $hero;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Hero $hero)
    {
        $this->hero = $hero;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
