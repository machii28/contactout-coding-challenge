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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($referralCode)
    {
        $this->referralCode = $referralCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Contact Out Referral Program')
            ->view('mail.referral');
    }
}
