<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\Food_itemController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\Food_itemRestaurantController;
use App\Http\Controllers\Admin\RestaurantStatisticController;
use App\Models\Food_item;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/orders/{restaurant}/food-items', [AdminOrderController::class, 'getFoodItemsForRestaurant']);
Route::get('/admin/restaurants/{restaurant}/orders', [AdminOrderController::class, 'indexForRestaurant'])->name('admin.restaurant.orders.index');
Route::get('/admin/restaurants/statistics', [RestaurantStatisticController::class, 'index'])->name('admin.restaurants.statistics.index');
Route::get('/admin/restaurants/statistics', [RestaurantStatisticController::class, 'index'])->name('admin.restaurants.statistics.index');
Route::get('/admin/restaurants/{restaurant}/statistics', [RestaurantStatisticController::class, 'show'])
    ->name('admin.restaurants.statistics.show');

Route::get('/dashboard', function () {
    $user = auth()->user();
    return view('admin.dashboard', ['email' => $user->email, 'address' => $user->address]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/get-address', function () {
    $address = auth()->user()->address;
    return response()->json($address);
})->middleware('auth');

Route::get('/get-email', function () {
    $email = auth()->user()->email;
    return response()->json($email);
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::resource('orders', AdminOrderController::class)->parameters(['orders' => 'order:slug']);
        //Restaurants Route
        Route::resource('restaurants', RestaurantController::class)->parameters(['restaurants' => 'restaurant:slug']);
        Route::resource('restaurants.food_items', Food_itemController::class)->parameters(['food_items' => 'food_item:slug',]);
    });

require __DIR__ . '/auth.php';
