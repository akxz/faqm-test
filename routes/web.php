<?php

use Illuminate\Support\Facades\Route;

use App\Modules\Order\Http\Controllers\OrderController;
use App\Modules\Product\Http\Controllers\ProductController;
use App\Modules\OrderProduct\Http\Controllers\OrderProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'index']);
Route::get('/cart/{userId}', [OrderController::class, 'getUnpaidOrder']);
Route::post('/order-products', [OrderProductController::class, 'createOrderProduct']);
Route::delete('/order/by-user/{userId}', [OrderController::class, 'deleteOrderByUser']);
