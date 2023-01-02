<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\CurrencyInterface;
use App\Http\Traits\CommonAppTrait;
use App\Models\Currency;

class CurrencyRepository implements CurrencyInterface
{
    use CommonAppTrait;
    /**
     * @var Currency
     */
    protected $model;

    /**
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->model = $currency;
    }

    /**
     * @param array $data
     * @param string $value
     * @return mixed
     */
    public function populateCurrenciesList(array $data, string $value)
    {
        return $this->model::upsert($data, $value);
    }

    /**
     * @return array
     */
    public function getDbCurrencies() : array
    {
        return $this->model::query()
            ->select( 'swift_code')
            ->whereIn('swift_code', $this->getRequestedCurrencies())
            ->get()
            ->toArray();
    }

    public function getBaseCurrency()
    {
        return  $this->model::join('base_currencies', 'currency_id.id', '=', 'currencies.id')
            ->pluck('currencies.swift_code')
            ->all();
    }


}
