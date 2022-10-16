<?php

namespace App\Modules\Product\Http\Controllers;

use App\Modules\Product\Http\Requests\GetProductsRequest;
use App\Modules\Product\Actions\GetProductFiltersAction;
use App\Modules\Product\Actions\GetProductsAction;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(GetProductsRequest $request)
    {
        $products = app(GetProductsAction::class)->run($request);
        $filters = app(GetProductFiltersAction::class)->run();

        return view('pages.products.index', compact('products', 'filters'));
    }
}
