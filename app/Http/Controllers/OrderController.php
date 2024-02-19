<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Food_item;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
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
        $restaurantId = Auth::user()->restaurant()->first()->id; 
       
        $orders = Order::whereHas('foodItems', function ($query) use ($restaurantId) {
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
        $food_items = Food_item::all(); 
        return view('admin.orders.create', compact('food_items'));
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
        $restaurantId = Auth::user()->restaurant()->first()->id;

        //contrrollare se order food item appartiene a ristorante registrato
        $orderBelongsToRestaurant = $order->foodItems()->whereHas('restaurant', function ($query) use ($restaurantId) {
            $query->where('id', $restaurantId);
        })->exists();

        if (!$orderBelongsToRestaurant) {
            // se l'ordine non appartiene, abort
            abort(403, 'Unauthorized action.');
        }
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $food_items = Food_item::all();
        return view('admin.orders.edit', compact('food_items', 'order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $order)
    {
        $form_input = $request->validated();
        $order->update($form_input);
        
        if ($order->has('food_items')) {
          
            $order->food_items()->sync($request->input('food_items', []));;
        } else {

            $order->food_items()->detach();
        }

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
