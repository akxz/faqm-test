<?php

namespace App\Modules\MealTypeProduct\Models;

use Illuminate\Database\Eloquent\Model;

class MealTypeProduct extends Model
{
    protected $table = 'meal_type_product';

    public $timestamps = false;

    protected $fillable = [
        'meal_type_id',
        'product_id',
    ];
}
