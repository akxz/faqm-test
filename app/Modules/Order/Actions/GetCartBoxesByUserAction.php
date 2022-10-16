<?php

namespace App\Modules\Order\Actions;

use App\Modules\Order\Tasks\GetUnpaidOrderByUserTask;
use App\Modules\Order\Subactions\GroupProductsByMaterialSubaction;
use App\Modules\Order\Subactions\GetProductsBoxesSubaction;

class GetCartBoxesByUserAction
{
    public function run($userId): array
    {
        $order = app(GetUnpaidOrderByUserTask::class)->run($userId);

        if (is_null($order)) {
            return [];
        }

        $groupedProducts = app(GroupProductsByMaterialSubaction::class)
            ->run($order);

        if (empty($groupedProducts)) {
            return [];
        }

        return app(GetProductsBoxesSubaction::class)->run($groupedProducts);
    }
}
