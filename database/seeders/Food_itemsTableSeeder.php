<?php

namespace Database\Seeders;

use App\Models\Food_item;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class Food_itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurants = Restaurant::pluck('id')->toArray();

        for ($i=0; $i < 50; $i++){
        $food_item= new Food_item();
        $food_item->name = $faker-> word();
        $food_item->image = $faker->image(null, 640, 480);
        $food_item->description = $faker-> text(200);
        $food_item->price = $faker->randomFloat(2, 0, 50);
        $food_item->is_visible = $faker->boolean();
        $food_item->restaurant_id = $faker->randomElement($restaurants);
        $food_item->save();
        }
    }
}
