<?php

namespace App\Providers;

use App\Http\Interfaces\CurrencyInterface;
use App\Http\Interfaces\ExchangeRateInterface;
use App\Http\Repositories\CurrencyRepository;
use App\Http\Repositories\ExchangeRateRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyInterface::class, CurrencyRepository::class);
        $this->app->bind(ExchangeRateInterface::class, ExchangeRateRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
