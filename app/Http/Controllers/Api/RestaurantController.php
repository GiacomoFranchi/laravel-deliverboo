<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(){
        $restaurants = Restaurant::with(['cuisinetype', 'food_items'])->paginate(3);
        return response()->json([
            'succes'=>true,
            'results'=>$restaurants
        ]);

    }

    public function show(string $slug)
    {
        $restaurants = Restaurant::with(['cuisinetype', 'food_items'])->paginate(3);
        return response()->json([
            'succes' => true,
            'results' => $restaurants
        ]);
    }
}
