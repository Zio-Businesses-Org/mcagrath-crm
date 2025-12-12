<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\WaiverFormSelfNotification;
use Illuminate\Support\Facades\Notification;

class SendSelfWaiverNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $vendor;
    /**
     * Create a new job instance.
     */
    public function __construct($email, $vendor)
    {
        $this->email = $email;
        $this->vendor = $vendor;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
     
        Notification::route('mail', $this->email)->notify(new WaiverFormSelfNotification($this->vendor));  

    }
}
