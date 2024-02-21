<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\CusineType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class CusineTypeRestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants= Restaurant::pluck('id')->toArray();
        $cusine_types= CusineType::pluck('id')->toArray();
        for($i=0; $i<30; $i++){

        $restaurantId = $faker->randomElement($restaurants);
        $cusine_typeId = $faker->randomElement($cusine_types);
          
        $pair= DB::table('cusine_type_restaurant')
        ->where('restaurant_id', $restaurantId)
        ->where('cusine_type_id', $cusine_typeId)
        ->exists();
        
        if(!$pair){
            $restaurant = Restaurant::find($restaurantId);
            $cuisine_type = CusineType::find($cusine_typeId);
            $restaurant->cusine_types()->attach($cuisine_type);   
        }
        
        }
    }
}
