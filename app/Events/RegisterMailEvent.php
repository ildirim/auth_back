<?php

namespace App\Events;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RegisterMailEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    use SerializesModels;
    public $userId;
    public $password;
    public function __construct($userId, $password)
    {
        $this->userId = $userId;
        $this->password = $password;
    }
    public function broadcastOn()
    {
        return [];
    }
}
