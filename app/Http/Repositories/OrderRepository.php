<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\OrderInterface;
use App\Http\Traits\CommonAppTrait;
use App\Models\Currency;
use App\Models\Order;

/**
 * Order repository
 */
class OrderRepository implements OrderInterface {

    use CommonAppTrait;

    /**
     * @var Order
     */
    protected $model;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $currencyId = Currency::where('swift_code', $data['foreign_currency'])->pluck('id');
        $data['user_id'] = $this->getAuthUser();
        $data['foreign_currency'] = $currencyId[0];

        return $this->model::create($data);
    }

    public function getOrder($id)
    {
        return Order::where('id', $id)->get();
    }

    public function delete($order)
    {
        return $order->delete();
    }

    public function getOrders()
    {
        return Order::get();
    }

}
