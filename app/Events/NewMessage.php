<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
	public $survey;

    public function __construct($data)
    {
    	$this->message = $data;
    }

	public function broadcastOn()
	{
		return new PresenceChannel('survey.' . $this->survey->id);
	}
//    public function broadcastOn()
//    {
//    	return ['chat'];
//    }

    public function broadcastAs()
	{
		return 'message';
	}
}
