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

    public function ShowRestaurantsByCuisineType($cusine_types_name)
    {
        $restaurants = Restaurant::whereHas('cusine_types', function ($query) use ($cusine_types_name) {
            $query->where('name', $cusine_types_name); 
        })->get();

        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);

    
    }
}
