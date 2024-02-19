<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\Food_itemController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Models\Food_item;
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

Route::get('/admin/food-items/create/{restaurant_id?}', [Food_itemController::class, 'create'])->name('admin.food_items.create');

Route::get('/admin/orders/{restaurant}/food-items', [AdminOrderController::class, 'getFoodItemsForRestaurant']);

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::resource('restaurant/food_items', Food_itemController::class)->parameters(['food_items' => 'food_item:slug']);
        Route::resource('orders', AdminOrderController::class)->parameters(['orders' => 'order:slug']);
    });



Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        //Restaurants Route
        Route::resource('restaurants', RestaurantController::class)->parameters(['restaurants' => 'restaurant:slug']);


    });

require __DIR__.'/auth.php';
