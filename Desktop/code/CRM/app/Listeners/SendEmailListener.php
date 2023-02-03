<?php

namespace App\Listeners;

use App\Mail\ClientMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailListener
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
     * @param  object  $email
     * @return void
     */
    public function handle($event)
    {
          Mail::to($event->email)->send(new \App\Mail\ClientMail);
    }
}
