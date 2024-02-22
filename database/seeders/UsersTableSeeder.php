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
        $emails =[
            "email1@email.com",
            "email2@email.com",
            "email3@email.com",
            "email4@email.com",
            "email5@email.com",
            "email6@email.com",
        ];
        $password = "password123";

        foreach ($emails as $email) {
            $user = new User();
            $user->name = $faker->word();
            $user->last_name = $faker->word();
            $user->address = $faker->address();
            $user->phone_number = $faker->phoneNumber();
            $user->password = Hash::make($password);
            $user->email =$email;
            $user->save();

        }
    }
}
