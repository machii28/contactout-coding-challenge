<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReferralRequest;
use App\Models\User;
use App\Services\Referral\ReferralServiceInterface;

class ReferralController extends Controller
{
    public function index()
    {
        return view('referral');
    }

    /**
     * @param ReferralServiceInterface $referralService
     * @param CreateReferralRequest $request
     * @return mixed
     */
    public function store(ReferralServiceInterface $referralService, CreateReferralRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();

        return $referralService->refer($user, request()->get('emails'));
    }
}
