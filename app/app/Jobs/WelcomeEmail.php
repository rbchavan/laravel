<?php

namespace App\Jobs;

use App\Mail\RegisterationMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class WelcomeEmail implements ShouldQueue
{
    use Queueable;


    public function __construct(private User $user)
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->queue(new RegisterationMail($this->user->name));
    }
}
