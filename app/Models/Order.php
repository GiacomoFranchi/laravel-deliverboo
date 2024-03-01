<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        return $this->belongsToMany(Food_item::class, 'Food_Item_Order')
            ->withPivot('quantity');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            
            $order->slug = Str::uuid();
        });

        static::created(function ($order) {

            $order->slug = Str::slug($order->customers_name . '-' . $order->order_time->format('Y-m-d-H-i-s') . '-' . $order->id);

            $order->save();
        });
    }
    protected $casts = [
        'order_time' => 'datetime',
    ];
}
