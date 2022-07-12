<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferralEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $referralCode;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($referralCode, $user)
    {
        $this->referralCode = $referralCode;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("{$this->user->name} recommends ContactOut")
            ->view('mail.referral');
    }
}
