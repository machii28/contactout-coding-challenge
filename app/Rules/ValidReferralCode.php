<?php

namespace App\Rules;

use App\Models\Referral;
use Illuminate\Contracts\Validation\Rule;

class ValidReferralCode implements Rule
{
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
        $referral = Referral::where('referral_code', $value)->where('email', request()->get('email'))->first();

        if (!$referral) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid :attribute';
    }
}
