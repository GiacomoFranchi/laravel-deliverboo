<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Food_item;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            $query->where('restaurant_id', $restaurantId);
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
        $order->save();
        $order->foodItems()->attach($request->input('food_item_ids'));
        $order->load('food_items');
        $order->total_price = $order->foodItems->sum('price');
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
        $orderBelongsToRestaurant = $order->foodItems()->whereHas('restaurant', function ($query) use ($restaurantId) {
            $query->where('id', $restaurantId);
        })->exists();

        if (!$orderBelongsToRestaurant) {
            // se l'ordine non appartiene, abort
            abort(403, 'Unauthorized action.');
        }

        $totalPrice = $order->foodItems->sum(function ($foodItem) {
            return $foodItem->price * $foodItem->pivot->quantity;
        });
        return view('admin.orders.show', compact('order'));
    }

    //test x filtrare piatti da ristorante 
    public function getFoodItemsForRestaurant($restaurantId)
    {
        $foodItems = Food_item::where(
            'restaurant_id',
            $restaurantId
        )->get();

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
