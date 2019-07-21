<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPizzaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pizzas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_pizza');
            $table->foreign('id_order')->references('id')->on('orders');
            $table->foreign('id_pizza')->references('id')->on('pizzas');
            $table->decimal('quantity');
            $table->string('comments')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_pizzas');
    }
}
