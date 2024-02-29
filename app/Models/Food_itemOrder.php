<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food_itemOrder extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'food_item_order';
}
