<?php

namespace App\Modules\Order\Tasks;

use App\Modules\Order\Models\Order;

class DeleteUnpaidOrderByUserTask
{
    private $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function run($userId)
    {
        return $this->model
            ->where([
                ['user_id', '=', $userId],
                ['paid', '=', 0]
            ])
            ->delete();
    }
}
