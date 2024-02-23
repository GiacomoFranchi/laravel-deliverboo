<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;



namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;

class BraintreeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway([
                'environment' => env('BRAINTREE_ENVIRONMENT'),
                'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
            ]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

