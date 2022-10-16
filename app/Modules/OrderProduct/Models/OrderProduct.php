<?php

namespace App\Modules\OrderProduct\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'count_items',
    ];
}
