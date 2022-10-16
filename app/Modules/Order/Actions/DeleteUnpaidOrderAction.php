<?php

namespace App\Modules\Order\Actions;

use App\Modules\Order\Tasks\DeleteUnpaidOrderByUserTask;

class DeleteUnpaidOrderAction
{
    public function run($userId): array
    {
        return app(DeleteUnpaidOrderByUserTask::class)->run($userId);
    }
}
