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
        Schema::create('order_pizza', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pizza');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_pizza')->references('id')->on('pizza');
            $table->string('comments');
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
        Schema::dropIfExists('order_pizza');
    }
}
