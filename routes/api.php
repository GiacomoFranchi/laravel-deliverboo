<?php

use App\Http\Controllers\Api\CuisineTypeController;
use App\Http\Controllers\Api\FoodItemController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\BrainTreeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurant/{slug}', [RestaurantController::class, 'show']);
Route::get('/restaurants/cusine_type/{cusine_types_name}', [RestaurantController::class, 'ShowRestaurantsByCuisineType']);
Route::get('/cusine_types', [CuisineTypeController::class, 'index']);
Route::get('/food_items', [FoodItemController::class, 'index']);
Route::post('/restaurant/{slug}/orders', [OrderController::class, 'store']);
Route::get('/braintree/token', [BrainTreeController::class, 'getToken'])->name('braintree.token');
Route::post('/braintree/checkout', [BrainTreeController::class, 'checkout'])->name('braintree.checkout');
