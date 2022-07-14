<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $successFulReferrals = auth()->user()->successfulReferrals()->get();

        return view('home')->with([
            'referral_points' => count($successFulReferrals),
            'successful_referrals' => $successFulReferrals
        ]);
    }
}
