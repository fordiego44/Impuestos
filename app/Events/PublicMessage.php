<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Message;

class PublicMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    { 
        $this->message = $message;
        // dd($message);
    //    $this->dontBroadcastToCurrentUser();
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

      
    public function broadcastOn()
    {
        return new Channel('public-channel-message');
    }

    public function broadcastAs() {
        return 'messageEvent';
    } 
    public function broadcastWith() {
         
        return ['message' => $this->message];
    }
}
