<?php

namespace App\Modules\Order\Tasks;

use App\Modules\Order\Models\Order;

class GetOrCreateUnpaidOrderByUserTask
{
    private $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function run($userId)
    {
        return $this->model->firstOrCreate(['user_id' => $userId, 'paid' => 0]);
    }
}
