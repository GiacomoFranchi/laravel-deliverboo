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
        $totalPrice = 0;

        DB::beginTransaction();
        try {
            $order = new Order();
            $order->fill($request->except('food_items'));
            $order->order_time = Carbon::now();
            $order->save();

            foreach ($request->food_items as $foodItem) {
                $item = Food_item::findOrFail($foodItem['id']);
                $quantity = $foodItem['quantity'] ?? 1; 
                $totalPrice += $item->price * $quantity;
                $order->food_items()->attach($item->id, ['quantity' => $quantity]);
            }

            $order->total_price = $totalPrice;
            $order->save();

            $paymentResult = $this->braintreeService->processPayment($request->payment_method_nonce, $totalPrice);
            if ($paymentResult->success) {
                DB::commit();
                return response()->json(['message' => 'Ordine creato e processato'], Response::HTTP_CREATED);
            } else {
                DB::rollBack();
                return response()->json(['error' => 'Processo di pagamento non riuscito'], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Si è verificato un errore'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

