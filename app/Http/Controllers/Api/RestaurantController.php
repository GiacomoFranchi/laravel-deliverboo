<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(){
        $restaurants = Restaurant::with(['cusine_types', 'food_items'])->paginate(10);
        return response()->json([
            'succes'=>true,
            'results'=>$restaurants
        ]);

    }

    public function show(string $slug)
    {
        $restaurant = Restaurant::with(['cusine_types', 'food_items'])->where('slug', $slug)->firstOrFail();
        return response()->json([
            'succes' => true,
            'results' => $restaurant
        ]);
    }
}
