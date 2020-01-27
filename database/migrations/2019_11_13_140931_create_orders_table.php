<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('Data zamówienia');
            $table->integer('Pracownik_id')->unsigned();
            $table->foreign('Pracownik_id')
             ->references('id')->on('employees')
             ->onDelete('cascade');
            $table->integer('Potrawa_id')->unsigned();
            $table->foreign('Potrawa_id')
             ->references('id')->on('dishes')
             ->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
