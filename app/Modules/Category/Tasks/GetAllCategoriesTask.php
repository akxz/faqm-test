<?php

namespace App\Modules\Category\Tasks;

use App\Modules\Category\Models\Category;

class GetAllCategoriesTask
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        return $this->model->get();
    }
}
