<?php

namespace App\Listeners;

use App\Events\SendMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendMailEvent  $event
     * @return void
     */
    public function handle(SendMailEvent $event)
    {
        $user = User::find($event->userId)->toArray();
        
        Mail::send('mail', ['image' => $user['qr_code_image'], 'content' => 'content'], function ($message)
        {
           $message->from('ildirim.huseyn@gmail.com', 'Christian Nwamba');
           $message->to('ildirim5895@gmail.com');
        });
    }
}
