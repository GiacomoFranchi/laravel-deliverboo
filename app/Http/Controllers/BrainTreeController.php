<?php

namespace App\Http\Controllers;

use App\Services\BraintreeService;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrainTreeController extends Controller
{
    protected $gateway;
    protected $braintreeService;

    public function __construct(Gateway $gateway, BraintreeService $braintreeService)
    {
        $this->gateway = $gateway;
        $this->braintreeService = $braintreeService;
    }

    public function getToken()
    {
        try {
            $clientToken = $this->braintreeService->generateClientToken();
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

        $result = $this->braintreeService->processPayment($nonceFromTheClient, $amount);

        if ($result->success) {
            Log::info('Pagamento riuscito', [
                'transaction_id' => $result->transaction->id,
                'amount' => $amount
            ]);
            return response()->json(['success' => true, 'transaction' => ['id' => $result->transaction->id]]);
        } else {
            return response()->json(['success' => false, 'message' => $result->message]);
        }
    }
}
