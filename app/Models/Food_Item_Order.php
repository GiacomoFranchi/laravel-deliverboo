<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Food_Item extends Model
{
    use HasFactory;

    protected $table = 'food_item_order';
    protected $fillable = ['quantity'];

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    public function food_item()
    {
        return $this->belongsToMany(Food_item::class);
    }

}
