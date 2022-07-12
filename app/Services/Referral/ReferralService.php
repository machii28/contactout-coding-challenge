<?php

namespace App\Services\Referral;

use App\Jobs\SendReferral;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Support\Str;

class ReferralService implements ReferralServiceInterface
{
    /**
     * @param User $user
     * @param array $emails
     * @return mixed|void
     */
    public function processReferral(User $user, array $emails = [])
    {
        foreach ($emails as $email) {
            $referral = new Referral();
            $referral->email = $email;
            $referral->referral_code = Str::random(16);
            $referral->userReferrer()->associate($user);

            $referral->save();

            SendReferral::dispatch($referral);
        }
    }
}
