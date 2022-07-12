<?php

namespace App\Rules;

use App\Models\Referral;
use Illuminate\Contracts\Validation\Rule;

class UninvitedEmails implements Rule
{
    public $referrals = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $referrals = [];

        foreach ($value as $key => $email) {
            if (Referral::where('email', $email)->first()) {
                $referrals[] = $email;
            }
        }

        $this->referrals = $referrals;

        return count($referrals) === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Emails ' . implode(', ', $this->referrals) . ' is already invited by other user';
    }
}
