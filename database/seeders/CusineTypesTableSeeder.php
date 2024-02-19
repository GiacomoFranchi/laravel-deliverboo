<?php

namespace Database\Seeders;

use App\Models\CusineType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CusineTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cusine_types = ['Italian', 'French', 'Chinese', 'Japanese','Greek','Spanish','Turkey','Thai','Mexican','American '];

        foreach ($cusine_types as $cusine_type) {
            $new_cusine_type= new CusineType;
            $new_cusine_type->name = $cusine_type;
            $new_cusine_type->save();
        }
    }
}
