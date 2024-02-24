<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestOrderRequest;
use App\Models\Food_item;
use App\Models\Order;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(GuestOrderRequest $request){

        //mettere tutto dentro una db:transaction
        DB::transaction(
            function () use ($request) {
                //creare ordine
                $order = new Order();
                $order->fill($request->except('food_items'));
                $order->order_time = Carbon::now();
                // $order->restaurant_id = $restaurant->id; 
                //slug temporaneo per non avere errori in fase di invio dati al db
                // $order->slug = 'temporary-slug'; 
                $order->save();

                //slug definitivo
                // $slug = Str::slug($request->input('customers_name') . '-' . $order->order_time->format('Y-m-d-H-i-s') . '-' . $order->id);
                // $order->slug = $slug;
                // $order->save();
                $totalPrice = 0;

                //// processare ogni food item inviato da f.e.
                foreach ($request->food_items as $foodItem) {
                    //trovare il fooditem x id o fail se non va 
                    $item = Food_item::findOrFail($foodItem['id']);
                    //trovare la quantità dalla richiesta e mettere a default 1 se non viene inserita
                    $quantity = $foodItem['quantity'];
                    //calcola il prezzo totale prezzo * quantità
                    $totalPrice += $item->price * $quantity;

                    // attacchare separatamente i food item con la quantità da inviare alla pivot
                    $order->food_items()->attach($item->id, ['quantity' => $quantity]);
                }

                // aggiornare il total price dopo che tutti gli item sono stati processati
                $order->total_price = $totalPrice;
                $order->save();
            }
        );

       
        return response()->json([
            'message' => 'Ordine creato con successo'
        ], 201); 
    }
}

