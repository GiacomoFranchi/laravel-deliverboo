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
            'restaurants.id',
            'restaurants.name',
            DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
            DB::raw('SUM(food_item_order.quantity * food_items.price) as total_revenue')
        )
        ->join('food_items', 'restaurants.id', '=', 'food_items.restaurant_id')
        ->join('food_item_order', 'food_items.id', '=', 'food_item_order.food_item_id')
        ->join('orders', 'food_item_order.order_id', '=', 'orders.id')
        ->where('restaurants.user_id', '=', Auth::user()->id)
        ->groupBy('restaurants.id', 'restaurants.name') 
        ->orderBy('total_orders', 'desc')
        ->get();

        $totalRestaurantsOwned = Restaurant::where('user_id', '=', Auth::user()->id)->count();

        $totalRevenueAll = $restaurantsData->sum('total_revenue');

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
        

        return view('admin.restaurants.statistics.index', compact('restaurantsData', 'totalRestaurantsOwned', 'totalOrderCount','totalRevenueAll'));
    }

    public function show(Restaurant $restaurant)
    {

     
        if ($restaurant->user_id !== Auth::id()
        ) {
           
            abort(403, 'Unauthorized action.');
        }


        $statistics = DB::table('food_items')
        ->join('food_item_order', 'food_items.id', '=', 'food_item_order.food_item_id')
        ->join('orders', 'food_item_order.order_id', '=', 'orders.id')
        ->where('food_items.restaurant_id', $restaurant->id)
        ->select(
            DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
            DB::raw('SUM(food_item_order.quantity * food_items.price) as total_revenue') 
        )
        ->first();


        $mostOrderedFoods = DB::table('food_items')
        ->join('food_item_order', 'food_items.id', '=', 'food_item_order.food_item_id')
        ->join('orders', 'food_item_order.order_id', '=', 'orders.id')
        ->where('food_items.restaurant_id', $restaurant->id)
        ->select(
            'food_items.name',
            DB::raw('COUNT(food_item_order.food_item_id) as order_count')
        )
        ->groupBy('food_items.name')
        ->orderBy('order_count', 'desc')
        ->get();
        

        return view('admin.restaurants.statistics.show', compact('restaurant', 'statistics', 'mostOrderedFoods'));
    }
}
