<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class UserEvent extends Event
{
    use SerializesModels;
    public $obj;

    /**
     * Create a new event instance.
     * @param $pvType
     * @param $pvId
     */
    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
