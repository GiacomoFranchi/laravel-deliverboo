<?php

namespace App\Http\Controllers;

use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrainTreeController extends Controller
{
    protected $gateway;

    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function getToken()
    {
        try {
            $clientToken = $this->gateway->clientToken()->generate();
            return response()->json(['token' => $clientToken]);
        } catch (\Exception $e) {
            Log::error("Error generating Braintree token: " . $e->getMessage());
            return response()->json(['error' => 'An error occurred while generating the token'], 500);
        }
    }

    // public function getToken()
    // {
    //     $clientToken = $this->gateway->clientToken()->generate();
    //     return response()->json(['token' => $clientToken]);
    // }

    public function checkout(Request $request)
    {


        $request->validate([
            'payment_method_nonce' => 'required|string',
            'amount' => 'required|numeric|between:0,9999.99',
        ]);

        $nonceFromTheClient = $request->input("payment_method_nonce");
        $amount = $request->input("amount"); 

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            // 'deviceData' => $deviceDataFromTheClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if ($result->success) {
            return response()->json(['success' => true, 'transaction' => ['id' => $result->transaction->id]]);
        } else {
            return response()->json(['success' => false, 'message' => $result->message]);
        }
    }
}
