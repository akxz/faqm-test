<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Тарелки',
            'Чашки',
            'Столовые приборы',
            'Для напитков',
            'Тара',
            'Одноразовая посуда',
        ];

        $materials = [
            'Стекло',
            'Пластик',
            'Нержавейка',
            'Алюминий',
            'Золото',
            'Дерево',
        ];

        $mealTypes = [
            'Суп',
            'Второе',
            'Завтрак',
            'Десерт',
            'Вечеринка',
            'Пикник',
        ];

        foreach ($categories as $category) {
            \App\Modules\Category\Models\Category::create(['name' => $category]);
        }

        foreach ($materials as $material) {
            \App\Modules\Material\Models\Material::create(['name' => $material]);
        }

        foreach ($mealTypes as $mealType) {
            \App\Modules\MealType\Models\MealType::create(['name' => $mealType]);
        }

        for ($i = 1; $i <= 20; $i++) {
            $product = \App\Modules\Product\Models\Product::create([
                'name' => 'Товар ' . $i,
                'category_id' => rand(1, 6),
                'material_id' => rand(1, 6),
                'weight' => rand(1, 10),
                'length' => rand(1, 10),
                'width' => rand(1, 10),
                'height' => rand(1, 10),
            ]);

            $mtCnt = rand(1, 3);
            $types = [];

            for ($j = 1; $j <= $mtCnt; $j++) {
                $type = rand(1, 6);

                while (in_array($type, $types)) {
                    $type = rand(1, 6);
                }

                $types[] = $type;

                \App\Modules\MealTypeProduct\Models\MealTypeProduct::create([
                    'meal_type_id' => $type,
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}
