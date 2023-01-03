<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/getCurrenciesList', [\App\Http\API\Controllers\CurrencyController::class, 'getCurrenciesList'])->name('currency.get');
Route::get('/orders/{id}', [\App\Http\API\Controllers\OrderController::class, 'getOrderById'])->name('orders.get_order_by_id');
Route::post('/orders/calculate', [\App\Http\API\Controllers\OrderController::class, 'calculate'])->name('calculation.calculate_currency');
Route::post('/orders/create', [\App\Http\API\Controllers\OrderController::class, 'store'])->name('orders.create_order');
Route::delete('/orders/{id}', [\App\Http\API\Controllers\OrderController::class, 'destroy'])->name('orders.delete_order');
Route::get('/orders', [\App\Http\API\Controllers\OrderController::class, 'getOrders'])->name('orders.get_orders');
Route::put('/orders/{id}', [\App\Http\API\Controllers\OrderController::class, 'update'])->name('orders.update_orders');

