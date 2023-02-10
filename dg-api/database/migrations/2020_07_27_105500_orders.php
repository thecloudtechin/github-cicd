<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no');
             $table->string('delivery_charges');
            
             $table->bigInteger('hotel_id');
            $table->bigInteger('user_id');
            $table->bigInteger('user_address_id');
            $table->bigInteger('amount');
            $table->integer('status');
                        $table->bigInteger('driver_id');
            $table->string('delivery_type');
            $table->string('payment_type');
            $table->string('day');
            $table->string('time');
            $table->string('note');
            $table->string('name');
            $table->string('number');
             $table->string('email');
            $table->integer('discount');
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
        //
        Schema::dropIfExists('orders');
    }
}
