<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Restaurants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('owner_name')->default('');
            $table->string('hotel_name')->default('');
            $table->string('address')->default('');
$table->string('imagePath')->default('');

            $table->string('owner_email')->default('');
            $table->string('hotel_email')->default('');
            $table->string('owner_mob')->default('');
            $table->string('hotel_mob')->default('');
            $table->string('owner_alt_mob')->default('');
            $table->string('hotel_alt_mob')->default('');
$table->integer('parent')->default(0);
            $table->integer('status')->default(0);
            $table->integer('discount')->default(0);
            $table->string('state')->default('');
            $table->string('country')->default('');
            $table->string('city')->default('');
            $table->string('pin')->default('');
            $table->string('take_away')->default('');
            $table->string('delivery')->default('');
             $table->string('delivery_status');
              $table->string('rest_status');
            $table->string('rating')->default('');
            $table->string('popular')->default('');
            $table->string('img')->default('');
            $table->string('delivery_charges')->default('');
            $table->string('free_over')->default('');
            $table->string('type')->default('');
$table->string('stripeKey')->default('');
$table->string('googleKey')->default('');
          

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
    }
}
