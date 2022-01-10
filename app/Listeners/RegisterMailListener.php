<?php

namespace App\Listeners;

use App\Events\RegisterMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RegisterMailListener
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
     * @param  \App\Events\RegisterMailEvent  $event
     * @return void
     */
    public function handle(RegisterMailEvent $event)
    {
        $user = User::find($event->userId)->toArray();
        Mail::send('mail', ['image' => $user['qr_code_image'], 'password' => $event->password], function ($message) use($user)
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
