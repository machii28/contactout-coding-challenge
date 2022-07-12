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
    public function processReferral(User $user, array $emails = []);
}
