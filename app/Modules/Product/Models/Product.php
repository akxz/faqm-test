<?php

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'material_id',
        'name',
        'weight',
        'length',
        'width',
        'height',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Modules\Category\Models\Category::class);
    }

    public function material()
    {
        return $this->belongsTo(\App\Modules\Material\Models\Material::class);
    }

    public function mealTypes()
    {
        return $this->belongsToMany(
            \App\Modules\MealType\Models\MealType::class
        );
    }
}
