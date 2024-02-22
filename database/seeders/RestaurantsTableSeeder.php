<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\CusineType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for($i=1; $i<15; $i++){
            $restaurant = new Restaurant();
            $restaurant->user_id =$faker->numberBetween(1, 3);
            $restaurant->name = $faker->word();
            $restaurant->address = $faker->address();
            $restaurant->vat_number =$faker->numerify('SA###########');
            $restaurant->phone_number = $faker->phoneNumber();
            $restaurant->opening_time = $faker->time($format = 'H:i');
            $restaurant->closing_time = $faker->time($format = 'H:i');
            $restaurant->closure_day = $faker->dayOfWeek();
            $restaurant->image = $faker->image(null, 640, 480);
            $restaurant->save();            
        }
    }
}
