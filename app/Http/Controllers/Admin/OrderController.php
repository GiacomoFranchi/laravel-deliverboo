<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Food_item;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stringable;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurantId = Auth::user()->restaurants->pluck('id');

        $orders = Order::whereHas('food_items', function ($query) use ($restaurantId) {
            $query->whereIn('restaurant_id', $restaurantId);
        })->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        $food_items = collect();

        return view('admin.orders.create', compact('restaurants', 'food_items'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $form_input = $request->validated();
        $order = new Order();
        $order->fill($form_input);
        $order->order_time = Carbon::now();
        $slug = Str::slug($request->input('customers_name') . '-' . $order->order_time->format('Y-m-d-H-i-s') . '-' . $order->id);

        $order->slug = $slug;
        $order->save();


        //aggiungi food items all'ordine
        $foodItemsInput = $request->input('food_items', []);
        //aggiungere quantità x ogni food item dal form.
        $quantities = $request->input('quantities', []);
        //inizializza array x trattenere i dati che saranno usati
        $attachData = [];
        //inizalizza total price
        $totalPrice = 0;
        //iterare array di food item
        foreach ($foodItemsInput as $index => $foodItemId) {
            //trova la quantità del food item correnti, default 1
            $quantity = isset($quantities[$index]) ? $quantities[$index] : 1;
            //trova foood item da id
            $food_items = Food_item::find($foodItemId);
            //se food item esiste, calcola parte del totale e prepara attach
            if ($food_items) {
                //aggiungere al totale, moltiplicare food item * sua quaantità
                $totalPrice += $food_items->price * $quantity;
                // attach con la quantità
                $attachData[$foodItemId] = ['quantity' => $quantity];
            }
        }

        // attach i food items con quantities
        $order->food_items()->attach($attachData);

        // aggiurna l'ordine totale 
        $order->total_price = $totalPrice;
        $order->save();


        return redirect()->route('admin.orders.show', ['order' => $order->slug])->with('message', 'Ordine creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $restaurantId = Auth::user()->restaurants->pluck('id');

        //contrrollare se order food item appartiene a ristorante registrato
        $orderBelongsToRestaurant = $order->food_items()->whereHas('restaurant', function ($query) use ($restaurantId) {
            $query->whereIn('id', $restaurantId);
        })->exists();

        if (!$orderBelongsToRestaurant) {
            // se l'ordine non appartiene, abort
            abort(403, 'Unauthorized action.');
        }
       
        return view('admin.orders.show', compact('order'));
    }

    //test x filtrare piatti da ristorante 
    public function getFoodItemsForRestaurant($restaurantId)
    {
        $foodItems = Food_item::where('restaurant_id', $restaurantId)->get();

        if ($foodItems->isEmpty()) {
            return response()->json(['message' => 'Nessun item trovato.'], 404);
        }

        return response()->json($foodItems);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $restaurants = Restaurant::all();
        $food_items = Food_item::all();
        return view('admin.orders.edit', compact('food_items', 'order', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderStatusRequest $request, Order $order)
    {
        //cancellato perché solo i clienti possono modificare il loro ordine mentre i ristoratori possono cambiare lo stato
        // $form_input = $request->validated();
        // $order->update($form_input);

        // if ($order->has('food_items')) {

        //     $order->foodItems()->sync($request->input('food_items', []));;
        // } else {

        //     $order->foodItems()->detach();
        // }
        $this->authorize('updateStatus', $order);

        $order->status = $request->validated()['status'];
        $order->save();

        return redirect()->route('admin.orders.show', ['order' => $order->slug])->with('message', 'Ordine aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('message', 'Ordine spostato nel cestino');
    }
}
