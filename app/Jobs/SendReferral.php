<?php

namespace App\Jobs;

use App\Mail\ReferralEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReferral implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $referral;

    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($referral, $user)
    {
        $this->referral = $referral;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->referral->email)
            ->send(new ReferralEmail($this->referral->referral_code, $this->user));
    }
}
