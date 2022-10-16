<?php

namespace App\Modules\OrderProduct\Actions;

use App\Modules\Order\Tasks\GetOrCreateUnpaidOrderByUserTask;
use App\Modules\OrderProduct\Tasks\AddProductToOrderTask;

class AddProductToOrderAction
{
    public function run($data)
    {
        $order = app(GetOrCreateUnpaidOrderByUserTask::class)
            ->run($data['user_id']);
        unset($data['user_id']);

        return app(AddProductToOrderTask::class)
            ->run($order->id, $data);
    }
}
