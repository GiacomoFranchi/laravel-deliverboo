<?php

namespace Database\Seeders;

use App\Models\Cusine_Type;
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
        $cusine_types = ['Italiana', 'Cinese', 'Messicana', 'Giapponese', 'Indiana', 'Francese', 'Thai', 'Greca', 'Spagnola'];

        foreach ($cusine_types as $cusine_type) {
            $new_cusine_type= new Cusine_Type();
            $new_cusine_type->name = $cusine_type;
            $new_cusine_type->save();
        }
    }
}
