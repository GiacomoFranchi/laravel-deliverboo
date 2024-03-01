<?php

namespace App\Providers;

use App\Services\BraintreeService;
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
        //  un'istanza singleton di Braintree\Gateway, ogni volta che la classe Gateway viene richiesta viene fornita questa istanza
        
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway([
                'environment' => env('BRAINTREE_ENVIRONMENT'),
                'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
            ]);
        });
        //istanza signleton per gestire le logiche di token e pagamento
        $this->app->singleton(BraintreeService::class, function ($app) {
            return new BraintreeService($app->make(Gateway::class));
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
