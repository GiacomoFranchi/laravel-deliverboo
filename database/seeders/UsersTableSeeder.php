<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $password = "password123";

        for ($i = 1; $i <= 39; $i++) {
            $user = new User();
            $user->name = $faker->firstName();
            $user->last_name = $faker->lastName();
            $user->address = $faker->address();
            $user->phone_number = $faker->phoneNumber();
            $user->password = Hash::make($password);
            $user->email = "email{$i}@email.com"; 
            $user->save();

        }
    }
}
