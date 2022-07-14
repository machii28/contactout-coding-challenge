<?php

namespace App\Services\Referral;

use App\Jobs\SendReferral;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ReferralService implements ReferralServiceInterface
{
    /**
     * @param User $user
     * @param array $emails
     * @return mixed|void
     */
    public function refer(User $user, array $emails = [])
    {
        foreach ($emails as $email) {
            $referral = new Referral();
            $referral->email = $email;
            $referral->referral_code = Str::random(16);
            $referral->userReferrer()->associate($user);

            $referral->save();

            SendReferral::dispatch($referral, $user);
        }

        return request()->wantsJson() ?
            new JsonResponse([
                'status' => 200,
                'message' => 'Referrals emails successfully sent'
            ], 200) : redirect()->back();
    }

    /**
     * @param User $user
     * @param Referral $referral
     * @return mixed|void
     */
    public function processReferral(User $user, Referral $referral)
    {
        $referrer = User::find($referral->referrer_user_id);

        $referrer->successfulReferrals()->attach($user);

        return $referrer->with('successfulReferral');
    }
}
