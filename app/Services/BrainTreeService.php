<?php

namespace App\Services;

use Braintree\Gateway as BraintreeGateway;



class BraintreeService
{
    protected $gateway;

    public function __construct(BraintreeGateway $gateway)
    {
        $this->gateway = $gateway;
    }
    
    public function generateClientToken()
    {
        return $this->gateway->clientToken()->generate();
    }

    public function processPayment($nonceFromTheClient, $amount)
    {
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'payment_method_nonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        return $result;
    }
}
