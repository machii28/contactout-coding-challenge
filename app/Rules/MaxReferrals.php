<?php

namespace App\Rules;

use App\Models\Referral;
use App\Models\SuccessfulReferral;
use Illuminate\Contracts\Validation\Rule;

class MaxReferrals implements Rule
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
        $user = auth()->user();

        $referrals = SuccessfulReferral::where('referrer_user_id', $user->id)->count();

        if ($referrals >= 10) {
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
        return 'Maximum referred users reached';
    }
}
