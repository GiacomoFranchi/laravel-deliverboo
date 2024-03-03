<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Food_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestaurantStatisticController extends Controller
{
    public function index()
    {
        // select dati dei ristoranti con tot ordini e tot fatturato 
        $restaurantsData = Restaurant::select(
            'restaurants.id',
            'restaurants.name',
            //conta n ordini
            DB::raw('COUNT(DISTINCT orders.id) as total_orders'), 
            // fatturato totale
            DB::raw('SUM(food_item_order.quantity * food_items.price) as total_revenue')
        )   //join su tabella food items
            ->join('food_items', 'restaurants.id', '=', 'food_items.restaurant_id')
             // join orders + fooditems
            ->join('food_item_order', 'food_items.id', '=', 'food_item_order.food_item_id')
             // join su orders
            ->join('orders', 'food_item_order.order_id', '=', 'orders.id') 
            //dove ristoranti dell'utente corrente
            ->where('restaurants.user_id', '=', Auth::user()->id)
            //group by id e nome ristorante
            ->groupBy('restaurants.id', 'restaurants.name') 
            //group by totale ordini, decrescente
            ->orderBy('total_orders', 'desc') 
            ->get();

        // conta il numero totale di ristoranti dell'utente
        $totalRestaurantsOwned = Restaurant::where('user_id', '=', Auth::user()->id)->count();

        // somma del fatturato totale di tutti i rostoranti
        $totalRevenueAll = $restaurantsData->sum('total_revenue');

        // conta il totale degli ordini nei ristoranti
        $totalOrderCount = Order::whereIn('id', function ($query) {
            $query->select('order_id')
            ->from('food_item_order')
            ->whereIn('food_item_id', function ($query) {
                $query->select('id')
                ->from('food_items')
                ->whereIn('restaurant_id', function ($query) {
                    $query->select('id')
                    ->from('restaurants')
                    ->where('user_id', Auth::user()->id); 
                });
            });
        })->count();

        return view('admin.restaurants.statistics.index', compact('restaurantsData', 'totalRestaurantsOwned', 'totalOrderCount', 'totalRevenueAll'));
    }

    public function show(Restaurant $restaurant)
    {
        // verifica diritti altrimenti 403
        if ($restaurant->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // somma tot ordini + fatturato di un singolo ristorante 
        $statistics = DB::table('food_items')
        ->join('food_item_order', 'food_items.id', '=', 'food_item_order.food_item_id')
        ->join('orders', 'food_item_order.order_id', '=', 'orders.id')
        ->where('food_items.restaurant_id', $restaurant->id)
            ->select(
                DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
                DB::raw('SUM(food_item_order.quantity * food_items.price) as total_revenue')
            )
            ->first();

        // food items più ordinati per conteggio ordini e prezzo decrescente
        $mostOrderedFoods = DB::table('food_items')
        ->join('food_item_order', 'food_items.id', '=', 'food_item_order.food_item_id')
        ->join('orders', 'food_item_order.order_id', '=', 'orders.id')
        ->where('food_items.restaurant_id', $restaurant->id)
            ->select(
                'food_items.name', 
                'food_items.price', 
                DB::raw('COUNT(food_item_order.food_item_id) as order_count') 
            )
            ->groupBy('food_items.name', 'food_items.price')
            ->orderBy('order_count', 'desc') 
            ->orderBy('food_items.price', 'desc') 
            ->get();

        
        return view('admin.restaurants.statistics.show', compact('restaurant', 'statistics', 'mostOrderedFoods'));
    }
}

