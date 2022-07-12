<?php

namespace App\Providers;

use App\Services\Referral\ReferralService;
use App\Services\Referral\ReferralServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ReferralServiceInterface::class, ReferralService::class);
    }
}
