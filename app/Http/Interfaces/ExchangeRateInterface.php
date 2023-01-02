<?php

namespace App\Http\Interfaces;

/**
 * Exchange rate interface
 */
interface ExchangeRateInterface {

    /**
     * @param array $data
     * @param string $value
     * @return mixed
     */
    public function insertOrUpdateExchangeRates(array $data, string $value);

}
