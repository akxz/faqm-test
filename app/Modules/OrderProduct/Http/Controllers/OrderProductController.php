<?php

namespace App\Modules\OrderProduct\Http\Controllers;

use App\Modules\OrderProduct\Http\Requests\CreateOrderProductRequest;
use App\Modules\OrderProduct\Actions\AddProductToOrderAction;
use App\Http\Controllers\Controller;

class OrderProductController extends Controller
{
    public function createOrderProduct(CreateOrderProductRequest $request)
    {
        $data = $request->validated();
        $orderProduct = app(AddProductToOrderAction::class)->run($data);

        return $orderProduct;
    }
}
