<?php

namespace App\Modules\MealType\Tasks;

use App\Modules\MealType\Models\MealType;

class GetAllMealTypesTask
{
    public function __construct(MealType $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        return $this->model->get();
    }
}
