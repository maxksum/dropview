<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RefreshTokenEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $accessToken;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->accessToken = $token;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['Token'];
    }

    public function broadcastAs()
    {
        return "refresh";
    }
}
