<?php
namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

trait CommonAppTrait {

    /**
     * @var
     */
    public $baseCurrency;

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getBaseCurrency()
    {
        return $this->baseCurrency = config('currency.base_currency');
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getRequestedCurrencies()
    {
        return config('currency.requested_currencies');
    }

    /**
     * @param $currency
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getRequestedExchangeRate($currency)
    {
        return config('currency.requested_exchange_rates.'.$currency);
    }

    /**
     * @param $currency
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getSurCharge($currency)
    {
       return config('currency.surcharges.'.$currency);
    }

    /**
     * @return \Illuminate\Redis\Connections\Connection
     */
    public function redisInstance()
    {
        return Redis::connection();
    }

    /**
     * @return int
     */
    public function getAuthUser() : int
    {
        //simulate user login
       Auth::login(User::where('email', 'ivan2302@gmail.com')->first());

       return Auth::user()->id;
    }

}
