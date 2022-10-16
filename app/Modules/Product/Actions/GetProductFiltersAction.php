<?php

namespace App\Modules\Product\Actions;

use App\Modules\Category\Tasks\GetAllCategoriesTask;
use App\Modules\Material\Tasks\GetAllMaterialsTask;
use App\Modules\MealType\Tasks\GetAllMealTypesTask;

class GetProductFiltersAction
{
    public function run()
    {
        $categories = app(GetAllCategoriesTask::class)->run();
        $materials = app(GetAllMaterialsTask::class)->run();
        $mealTypes = app(GetAllMealTypesTask::class)->run();

        return compact('categories', 'materials', 'mealTypes');
    }
}
