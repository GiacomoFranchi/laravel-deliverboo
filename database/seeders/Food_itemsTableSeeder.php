<?php

namespace Database\Seeders;

use App\Models\CusineType;
use App\Models\Food_item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class Food_itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $foodItemsData = include 'food_items_data.php';
        
        foreach ($foodItemsData as $cusineType => $foodItems) {
            foreach ($foodItems as $item) {
                $foodItem = new Food_item();
                $foodItem->name = $item['name'];
                $foodItem->slug = Str::slug($item['name']);
                $foodItem->description = $item['description'];
                $foodItem->price = $item['price'];
                $foodItem->is_visible = $faker->boolean();
                $foodItem->cusine_type_id = CusineType::where('name', $cusineType)->first()->id;
                $foodItem->image = $faker->image(null, 640, 480); // Corretto utilizzo di $faker
        
                $foodItem->save();
            }
        }
        
        
        
        // for ($i=0; $i < 20; $i++){
        // $food_item= new Food_item();
        // $food_item->name = $faker-> word();
        // $food_item->image = $faker->image(null, 640, 480);
        // $food_item->description = $faker-> text(200);
        // $food_item->price = $faker->randomFloat(2, 0, 50);
        // $food_item->is_visible = $faker->boolean();
        // $food_item->restaurant_id = $faker->numberBetween(5, 11);
        // $food_item->save();
        // }
    }
}
