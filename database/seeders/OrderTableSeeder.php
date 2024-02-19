<?php

namespace Database\Seeders;

use App\Models\Order;
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

        for ($i=0; $i < 5; $i++) {

            $order = new Order;
            $order->order_time = $faker->dateTimeBetween('now', '+1 week')->format('Y-m-d H:i:s');
            $order->customers_name = $faker->name;
            $order->customers_address = $faker->address;
            $order->customers_email = $faker->email;
            $order->customers_phone_number = $faker->phoneNumber;
            $order->status = null;
            $order->total_price = null;
            $order->save();
            
       
            $slug = Str::slug($order->customers_name . '-' . $order->order_time . '-' . $order->id, '-');
            $order->slug = $slug;
            $order->save();
        }
        
    }
}
