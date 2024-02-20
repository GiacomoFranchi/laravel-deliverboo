<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    use HasFactory;


    public $fillable = ['name','user_id', 'address','image', 'vat_number', 'phone_number', 'opening_time', 'closing_time', 'closure_day'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function food_items(){
        return $this->hasMany(Food_item::class);
    }

    public function cusine_types() {
        return $this->belongsToMany(CusineType::class);
    }
}
