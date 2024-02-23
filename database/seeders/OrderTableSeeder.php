<?php

namespace Database\Seeders;

use App\Models\Food_item;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use illuminate\Support\Str;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {


        $restaurants = Restaurant::all();

        foreach ($restaurants as $restaurant) {
            $foodItems = $restaurant->food_items; 

            for ($i = 0; $i < 5; $i++) { 
                $order = Order::create([
                    'order_time' => $faker->dateTimeBetween('now'),
                    'customers_name' => $faker->name,
                    'customers_address' => $faker->address,
                    'customers_email' => $faker->email,
                    'customers_phone_number' => $faker->phoneNumber,
                    'status' => 'pending', 
                    
                ]);

                $totalPrice = 0;
                $selectedFoodItems = $foodItems->random(1); 

                foreach ($selectedFoodItems as $foodItem) {
                    $quantity = rand(1, 5); 
                    $totalPrice += $foodItem->price * $quantity; 

                    
                    $order->food_items()->attach($foodItem->id, ['quantity' => $quantity]);
                }

               
                $order->total_price = $totalPrice;
                $order->save();
            }
        }
    }


        

}
