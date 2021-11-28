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
        Mail::send('mail', ['image' => $user['qr_code_image']], function ($message) use($user)
        {
           $message->subject('Milli Observatoriya - Giriş üçün QR kod');
           $message->from('ildirim.huseyn@gmail.com', 'Əmək Bazarı və Sosial Müdafiə Məsələləri üzrə Milli Observatoriya');
           $message->to($user['email']);
           $message->attach(url('/images/qr/' . $user['qr_code_image']), [
                         'as' => 'qr.png'
                    ]);
        });
    }
}
