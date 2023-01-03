<?php
namespace App\Http\Services;

use App\Http\Repositories\CurrencyRepository;
use App\Http\Repositories\OrderRepository;
use App\Http\Traits\ActionsTrait;
use App\Http\Traits\CommonAppTrait;

class OrderService {

    use CommonAppTrait, ActionsTrait;

    /**
     * @var CurrencyRepository
     */
    protected $orderRepository;

    /**
     * @var float
     */
    public float $surCharge;
    /**
     * @var float
     */
    public float $exchangeRate;
    /**
     * @var float
     */
    public float $amountToPay;
    /**
     * @var float
     */
    public float $amountToPayIncludingSurcharge;
    /**
     * @var float|int
     */
    public float $surChargeAmount = 0;
    /**
     * @var float|int
     */
    public float $totalDiscount = 0;
    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param $calculationData
     * @return array
     */
    public function calculate($calculationData) : array
    {
        $this->exchangeRate = $this->redisInstance()->mget([$calculationData->currency])[0];
        $this->surCharge = $this->getSurCharge($calculationData->currency);
        $this->amountToPay = (1/$this->exchangeRate)*$calculationData->amount;
        $this->surChargeAmount = $this->amountToPay*($this->surCharge/100);
        $this->amountToPayIncludingSurcharge = $this->amountToPay + $this->surChargeAmount;

        if($this->hasDiscount($calculationData->currency)) {
            $this->totalDiscount = ($this->discount/100)*$this->amountToPayIncludingSurcharge;
        }

        return [
            'foreign_currency'=> $calculationData->currency,
            'exchange_rate' => $this->exchangeRate,
            'surcharge_percent' => $this->surCharge,
            'surcharge_amount' => round($this->surChargeAmount, 4),
            'foreign_currency_amount' => (int)$calculationData->amount,
            'total_paid_amount' => round ($this->amountToPayIncludingSurcharge-$this->totalDiscount, 4),
            'discount_percent' => $this->discount,
            'total_discount' => round($this->totalDiscount,4)
        ];
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data) : mixed
    {
       return $this->orderRepository->create($data);
    }

    /**
     * @param $id
     * @return false|mixed
     */
    public function delete($id)
    {
        $order = $this->getOrderById($id);
        if(!$order) {
            return false;
        }

        return $this->orderRepository->delete($order);
    }

    /**
     * @return mixed|null
     */
    public function getOrders()
    {
        if($this->orderRepository->getOrders()->isEmpty()) {
            return false;
        }

        return $this->orderRepository->getOrders();
    }

    /**
     * @param $id
     * @return false|mixed
     */
    public function  getOrderById($id)
    {
        if(is_null($this->orderRepository->getOrder($id))) {
            return false;
        }
        return $this->orderRepository->getOrder($id);
    }

    /**
     * @param array $data
     * @param $id
     * @return false|mixed
     */
    public function updatePayment(array $data, $id)
    {
        $updatedOrder = $this->orderRepository->update($data, $id);
        if($updatedOrder) {
            return $updatedOrder;
        }

        return false;
    }
}


