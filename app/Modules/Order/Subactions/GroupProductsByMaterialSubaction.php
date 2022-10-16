<?php

namespace App\Modules\Order\Subactions;

use App\Modules\Order\Models\Order;

class GroupProductsByMaterialSubaction
{
    public function run(Order $order): array
    {
        $result = [];

        $materialGrouped = collect($order->products)->groupBy('material_id');

        foreach ($materialGrouped as $materialKey => $products) {
            foreach ($products as $product) {
                $result[$materialKey][] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'material_name' => $product->material->name,
                    'weight' => $product->weight,
                    'count_items' => $product->pivot->count_items,
                    'length' => $product->length,
                    'width' => $product->width,
                    'height' => $product->height,
                    'meal_types' => collect(json_decode($product->mealTypes))->pluck('name')->unique()->toArray(),
                ];
            }
        }

        return $result;
    }
}
