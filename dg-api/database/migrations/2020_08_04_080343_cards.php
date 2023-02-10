<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('card_no');
            $table->string('cvv');
            $table->string('card_type');
            $table->bigInteger('user_id');
            $table->integer('status')->default(0);
            $table->string('exp_month')->default(0);
            $table->string('exp_year')->default(0);
            $table->string('modified_date')->default(0);
            $table->string('name_on_card')->default(0);
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
