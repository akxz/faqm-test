<?php

namespace App\Modules\OrderProduct\Tasks;

use App\Modules\OrderProduct\Models\OrderProduct;

class AddProductToOrderTask
{
    private $model;

    public function __construct(OrderProduct $model)
    {
        $this->model = $model;
    }

    public function run($orderId, $data)
    {
        return $this->model->updateOrCreate(
            ['order_id' => $orderId, 'product_id' => $data['product_id']],
            ['count_items' => $data['count_items']],
        );
    }
}
