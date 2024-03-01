<?php

namespace Database\Seeders;

use App\Models\CusineType;
use App\Models\Food_item;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class RestaurantsDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $jsonPath = base_path('MOCK_DATA (1).json');; 
        $data = json_decode(file_get_contents($jsonPath), true);

        foreach ($data['Restaurants'] as $restaurantData) {

            $openingTime = Carbon::createFromTime($faker->numberBetween(6, 11), 0, 0);
            $closingTime = (clone $openingTime)->addHours(rand(8, 12));

            $imagePath = $restaurantData['image'] ? 'restaurants_images/' . $restaurantData['image'] : null;

            $restaurant = Restaurant::updateOrCreate(
                ['vat_number' => $faker->numerify('IT###########')],
                [ 
                    'name' => $restaurantData['name'],
                    'address' => $restaurantData['address'],
                    'phone_number' => $faker->phoneNumber(),
                    'user_id' =>$faker->numberBetween(1, 6),
                    'opening_time' => $openingTime->format('H:i:s'),
                    'closing_time' => $closingTime->format('H:i:s'),
                    'closure_day' => $faker->dayOfWeek(),
                    'image' => $imagePath,
                    
                ]
            );

           
            foreach ($restaurantData['cuisineType'] as $cuisineName) {
                $cuisineType  = CusineType::firstOrCreate(
                    ['name' => $cuisineName],
                    ['slug' => Str::slug($cuisineName)]
                );
               
                $restaurant->cusine_types()->syncWithoutDetaching([$cuisineType->id]);
            }

           
            foreach ($restaurantData['foodItem'] as $foodItemData) {
                Food_item::updateOrCreate(
                    [
                        'restaurant_id' => $restaurant->id,
                        'name' => $foodItemData['name'],
                        'description' => $foodItemData['description'],
                        'price' => $foodItemData['price'],
                        'image' => $faker->image(null, 640, 480), 
                        'is_visible' => 1, 
                       
                    ]
                );
            }
        }
    }
}
