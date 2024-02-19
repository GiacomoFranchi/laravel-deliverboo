<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Food_item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'description', 'price','is_visible'];

    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
