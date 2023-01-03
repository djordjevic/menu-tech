<?php

namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'from_currency' => 'USD',
                'to_currency' => 'JPY',
                'exchange_rate' => 107.17
            ],
            [
                'id' => 2,
                'from_currency' => 'USD',
                'to_currency' => 'GBP',
                'exchange_rate' => 0.711178
            ],
            [
                'id' => 3,
                'from_currency' => 'USD',
                'to_currency' => 'EUR',
                'exchange_rate' => 0.884872
            ]];

        foreach ($data as $value) {
            ExchangeRate::create($value);
        }

    }
}
