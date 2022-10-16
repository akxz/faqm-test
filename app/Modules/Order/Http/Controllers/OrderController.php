<?php

namespace App\Modules\Order\Http\Controllers;

use App\Modules\Order\Actions\GetCartBoxesByUserAction;
use App\Modules\Order\Actions\DeleteUnpaidOrderAction;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function getUnpaidOrder(int $userId)
    {
        $boxes = app(GetCartBoxesByUserAction::class)->run($userId);

        return view('pages.cart.unpaid_order', compact('boxes'));
    }

    public function deleteOrderByUser(int $userId)
    {
        return app(DeleteUnpaidOrderAction::class)->run($userId);
    }
}
