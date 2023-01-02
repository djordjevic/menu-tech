<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ExchangeRatesSeeder::class,
        ]);

        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Ivan Dj',
            'email' => 'ivan2302@gmail.com',
        ]);
    }
}
