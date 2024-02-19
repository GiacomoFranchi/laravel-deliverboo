<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_time',
        'customer_name',
        'customer_address',
        'customer_email',
        'customer_phone_number',
        'status',
        'total_price',
    ];
}
