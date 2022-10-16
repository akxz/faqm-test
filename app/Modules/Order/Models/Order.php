<?php

namespace App\Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'paid',
    ];

    protected $casts = [
        'paid' => 'boolean',
    ];

    public function products()
    {
        return $this->belongsToMany(
            \App\Modules\Product\Models\Product::class,
            'order_products'
        )->withPivot('count_items');
    }
}
