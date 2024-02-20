<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_time',
        'customers_name',
        'customers_address',
        'customers_email',
        'customers_phone_number',
        'status',
        'total_price',
        'slug',
        'food_item_id',
        'order_time'
    ];

    public function food_items()
    {
        return $this->belongsToMany(Food_item::class, 'Food_Item_Order');
    }
}
