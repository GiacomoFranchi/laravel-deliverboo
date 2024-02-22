<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CusineType;
use Illuminate\Http\Request;

class CuisineTypeController extends Controller
{
    public function index()
    {
        $cuisine_types = CusineType::all();
        return response()->json([
            'results' => $cuisine_types,
            'success' => true,
        ]);
    }
}
