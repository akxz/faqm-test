<?php

namespace App\Modules\Product\Actions;

use App\Modules\Product\Http\Requests\GetProductsRequest;
use App\Modules\Product\Tasks\GetProductsTask;

class GetProductsAction
{
    public function run(GetProductsRequest $request)
    {
        $data = $request->validated();

        return app(GetProductsTask::class)->run($data);
    }
}
