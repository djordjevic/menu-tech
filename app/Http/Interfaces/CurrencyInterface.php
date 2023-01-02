<?php

namespace App\Http\Interfaces;

/**
 * Currency interface
 */
interface CurrencyInterface
{
    /**
     * @param array $data
     * @param string $value
     * @return mixed
     */
    public function populateCurrenciesList(array $data, string $value);

    /**
     * @return mixed
     */
    public function getDbCurrencies();
}
