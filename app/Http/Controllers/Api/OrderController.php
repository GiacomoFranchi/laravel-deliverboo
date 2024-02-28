<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestOrderRequest;
use App\Models\Food_item;
use App\Models\Order;
use App\Models\Restaurant;
use App\Services\BraintreeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
class OrderController extends Controller
{

    protected $braintreeService;

    public function __construct(BraintreeService $braintreeService) 
    {
        $this->braintreeService = $braintreeService;
    }

    public function store(GuestOrderRequest $request)
    {
        Log::info('Payment request initiated', ['request_data' => $request->all()]);
        $totalPrice = 0;


        DB::beginTransaction();
        Log::info(['request_data' => $request->all()]);
        try {
            $order = new Order();
            $order->fill($request->except('food_items'));
            $order->order_time = Carbon::now();
            $order->save();
            foreach ($request->food_items as $foodItem) {
                $item = Food_item::findOrFail($foodItem['id']);
                $quantity = $foodItem['quantity']; 
                $totalPrice += $item->price * $quantity;
                $order->food_items()->attach($item->id, ['quantity' => $quantity]);
            }

            $order->total_price = $totalPrice;
            $order->save();

            $paymentResult = $this->braintreeService->processPayment($request->paymentMethodNonce, $totalPrice);
            Log::info('Payment result', ['success' => $paymentResult->success, 'message' => $paymentResult->message]);
            if ($paymentResult->success) {
                DB::commit();
                return response()->json(['message' => 'Ordine creato e processato'], Response::HTTP_CREATED);
            } else {
                DB::rollBack();
                return response()->json(['error' => 'Processo di pagamento non riuscito'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error processing payment', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Si è verificato un errore'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

