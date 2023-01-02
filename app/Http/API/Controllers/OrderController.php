<?php

namespace App\Http\API\Controllers;

use App\Http\API\Controllers\Controller;
use App\Http\Api\Requests\CalculationRequest;
use App\Http\API\Requests\CreateOrderRequest;
use App\Http\API\Requests\DeleteOrderRequest;
use App\Http\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calculate(CalculationRequest $calculationRequest)
    {
        return response()->success($this->orderService->calculate($calculationRequest), '200' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $createOrderRequest)
    {
        if(!$this->orderService->create($createOrderRequest->all())) {
            return response()->error(['message' => 'Error creating order.'], '200');
        }

        return response()->success(['message' => 'Order has been saved'], '201');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOrders()
    {
        $orders = $this->orderService->getOrders();

        if(!$orders) {
            return response()->error(['message' => 'There is no saved orders'], '200');
        }

        return response()->success($orders, '200');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function getOrderById($id)
    {
        $order = $this->orderService->getOrderById($id);

        if(!$order) {
            return response()->error(['message' => 'There is no saved orders'], '200');
        }

        return response()->success($order, '200');    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
       if($this->orderService->delete($id)) {
           return response()->success(['message' => 'Order has been deleted'], '200');

       }
    }
}