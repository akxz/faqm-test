<?php

namespace App\Modules\Order\Tasks;

use App\Modules\Order\Models\Order;

class GetUnpaidOrderByUserTask
{
    private $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function run($userId)
    {
        return $this->model
            ->with([
                'products.category',
                'products.material',
                'products.mealTypes'
            ])
            ->where([
                ['user_id', '=', $userId],
                ['paid', '=', 0]
            ])
            ->first();
    }
}
