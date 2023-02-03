<?php

namespace App\Events;

use App\Models\Cart;
use App\Models\Discount;
use App\Models\Dish;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class cartUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cartItem;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($cartItem)
    {
            $this->cartItem=$cartItem;
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
