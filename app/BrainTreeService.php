<?php

namespace App\Services;

use Braintree\Gateway;
use Braintree\Transaction;

class BraintreeService
{
    protected $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function processPayment($nonce, $amount)
    {
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        return $result;
    }
}
