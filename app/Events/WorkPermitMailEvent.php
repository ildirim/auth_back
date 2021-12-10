<?php

namespace App\Events;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WorkPermitMailEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    use SerializesModels;
    public $userId;
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    public function broadcastOn()
    {
        return [];
    }
}
