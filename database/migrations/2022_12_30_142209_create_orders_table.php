<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('foreign_currency')->unsigned();
            $table->float('exchange_rate', 16, 6);
            $table->integer('surcharge_percent');
            $table->float('surcharge_amount', 16, 6);
            $table->integer('foreign_currency_amount');
            $table->float('total_paid_amount', 16, 6);
            $table->integer('discount_percent');
            $table->float('discount_amount', 16, 6);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('foreign_currency')->references('id')->on('currencies');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
