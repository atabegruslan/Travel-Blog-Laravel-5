<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CrudLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;
    public $table;
    public $method;
    public $recordKeyName;
    public $recordId;
    public $parameters;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($model, $table, $method, $recordKeyName, $recordId, $parameters)
    {
        $this->model         = $model;
        $this->table         = $table;
        $this->method        = $method;
        $this->recordKeyName = $recordKeyName;
        $this->recordId      = $recordId;
        $this->parameters    = $parameters;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
