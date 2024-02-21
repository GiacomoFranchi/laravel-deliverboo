<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food_item;
use Illuminate\Http\Request;

class FoodItemController extends Controller
{
    public function index()
    {
        $food_items = Food_item::all();
        return response()->json([
            'results' => $food_items,
            'success' => true,
        ]);
    }
}
