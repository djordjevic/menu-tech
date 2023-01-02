<?php

namespace App\Http\Traits;

trait ActionsTrait {

    /**
     * @var int
     */
    public int $discount = 0;
    /**
     * @var bool
     */
    public bool $email = false;

    /**
     * @param $currency
     * @return mixed
     */
    public function hasDiscount($currency) :mixed
    {
        $this->discount = config('currency.total_discount.'.$currency);

        return $this->discount;
    }

    /**
     * @param $currency
     * @return bool
     */
    public function hasEmail($currency) : bool
    {
        $this->email = config('currency.confirmaton_mail.'.$currency);

        return $this->email;
    }


}
