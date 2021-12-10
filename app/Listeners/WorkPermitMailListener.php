<?php

namespace App\Listeners;

use App\Events\WorkPermitMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\UserService;
use Illuminate\Support\Facades\Mail;

class WorkPermitMailListener
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
     * @param  \App\Events\WorkPermitMailEvent  $event
     * @return void
     */
    public function handle(WorkPermitMailEvent $event)
    {
        $userService = new UserService();
        $user = $userService->userById($event->userId);
        Mail::send('work_permit', ['url' => 'sssdsd'], function ($message) use($user)
        {
           $message->subject('Milli Observatoriya - Icaze');
           $message->from('ildirim.huseyn@gmail.com', 'Əmək Bazarı və Sosial Müdafiə Məsələləri üzrə Milli Observatoriya');
           $message->to($user->email);
        });
    }
}
