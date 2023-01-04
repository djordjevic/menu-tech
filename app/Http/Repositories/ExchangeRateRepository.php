<?php
namespace App\Http\Repositories;

use App\Models\ExchangeRate;

class ExchangeRateRepository {

    /**
     * @var ExchangeRate
     */
    protected $exchangeRateModel;

    /**
     * @param ExchangeRate $exchangeRate
     */
    public function __construct(ExchangeRate $exchangeRate)
    {
        $this->exchangeRateModel = $exchangeRate;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertOrUpdateExchangeRates(array $data)
    {
        return $this->exchangeRateModel::upsert($data, 'exchange_rates_from_currency_to_currency_unique');
    }


}
