<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        WelcomeEmail::dispatch($event->user)->onQueue('email');
    }
}
