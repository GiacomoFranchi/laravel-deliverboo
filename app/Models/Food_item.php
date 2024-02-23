<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class Food_item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'description', 'price','is_visible', 'restaurant_id'];

    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value) . '-' . $this->restaurant_id . '-'. (rand(0, 10000) * rand(1, 10));
    }
    
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
