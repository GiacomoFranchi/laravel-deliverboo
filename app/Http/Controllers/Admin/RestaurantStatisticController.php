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
       
        $restaurantsData = Restaurant::select(
            'restaurants.name',
            DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
            DB::raw('SUM(food_item_order.quantity * food_items.price) as total_revenue')
        )
        ->join('food_items', 'restaurants.id', '=', 'food_items.restaurant_id')
        ->join('food_item_order', 'food_items.id', '=', 'food_item_order.food_item_id')
        ->join('orders', 'food_item_order.order_id', '=', 'orders.id')
        ->where('restaurants.user_id', '=', Auth::user()->id) 
            ->groupBy('restaurants.name')
            ->get();

        $totalRestaurantsOwned = Restaurant::where('user_id', '=', Auth::user()->id)->count();
        

        return view('admin.restaurants.statistics.index', compact('restaurantsData', 'totalRestaurantsOwned'));
    }

    public function show($restaurantId)
    {

        //user auth
        $restaurant = Restaurant::where('id', $restaurantId)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        
        $statistics = DB::table('food_items')
        ->join('food_item_order', 'food_items.id', '=', 'food_item_order.food_item_id')
        ->join('orders', 'food_item_order.order_id', '=', 'orders.id')
        ->where('food_items.restaurant_id', $restaurant->id)
            ->select(
                DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
                DB::raw('SUM(food_item_order.quantity * food_item_order.price) as total_revenue')
            )
            ->first();

        return view('statistics.show', compact('restaurant', 'statistics'));
    }
}
