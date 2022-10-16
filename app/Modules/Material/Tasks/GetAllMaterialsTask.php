<?php

namespace App\Modules\Material\Tasks;

use App\Modules\Material\Models\Material;

class GetAllMaterialsTask
{
    public function __construct(Material $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        return $this->model->get();
    }
}
