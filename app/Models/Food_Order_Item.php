<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Food_Item extends Model
{
    use HasFactory;

    protected $table = 'food_order_item';
    protected $fillable = ['quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function food_item()
    {
        return $this->belongsTo(Food_item::class);
    }

}
