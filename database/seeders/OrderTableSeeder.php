<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

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

            Order::create([
            'order_time' => $faker->dateTimeBetween('now', '+1 week')->format('Y-m-d H:i:s'),
            'customer_name' => $faker->name,
            'customer_address' => $faker->address,
            'customer_email' => $faker->email,
            'customer_phone_number' => $faker->phoneNumber,
            'status' => null, 
            'total_price' => null,
            
        ]);
        }
        
    }
}
