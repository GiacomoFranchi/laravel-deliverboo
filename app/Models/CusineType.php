<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cusine_Type extends Model
{
    use HasFactory;
    
    //Relationship with Restaurants (Many-to-Many)
    public function restaurants(){
        return $this->belongsToMany(Restaurant::class);
    }
}
