<?php

namespace Database\Seeders;

use App\Models\Food_item;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class FoodItemOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $orders = Order::pluck('id')->toArray();
        $food_items = Food_item::pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {
            $order_id = $faker->randomElement($orders);
            $food_item_id = $faker->randomElement($food_items);

           
            $pairExists = DB::table('food_item_order') 
            ->where('order_id', $order_id)
                ->where('food_item_id', $food_item_id)
                ->exists();

            if (!$pairExists) {
               
                $order = Order::find($order_id);
                $quantity = $faker->numberBetween(1, 5); 

                
                $order->food_items()->attach([$food_item_id => ['quantity' => $quantity]]);
            }
        }
    }
}
