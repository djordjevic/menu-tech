<?php

namespace App\Observers;
use App\Http\Traits\ActionsTrait;
use App\Models\Order;
use App\Mail\OrderConfrimationMail;

class CreateOrderObserver
{
    use ActionsTrait;

    public function created(Order $order)
    {
        $withUserData = $order->query()
            ->where('id', $order->id)
            ->withEmailAndCurrency()
            ->get()
            ->toArray();

        if($this->hasEmail($withUserData[0]['swift_code'])) {
            \Mail::to($withUserData[0]['email'])->send(new OrderConfrimationMail($withUserData[0]));
        }

        return false;
    }


}
