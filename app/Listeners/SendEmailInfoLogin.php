<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailInfoLogin
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $amil = $event->user;

        Mail::send('emails.login-detail', ['amil' => $amil], function($message) use ($amil) {
            $message->from('email@example.com', config('app.name'));
            $message->subject('DATA LOGIN AMIL');
            $message->to($amil->email);
        });
    }
}
