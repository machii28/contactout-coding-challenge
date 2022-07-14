<?php

namespace App\Services\Referral;

use App\Models\Referral;
use App\Models\User;

interface ReferralServiceInterface
{
    /**
     * @param User $user
     * @param array $emails
     * @return mixed
     */
    public function refer(User $user, array $emails = []);

    /**
     * @param User $user
     * @param Referral $referral
     * @return mixed
     */
    public function processReferral(User $user, Referral $referral);
}
