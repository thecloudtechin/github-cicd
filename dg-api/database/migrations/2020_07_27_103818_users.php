<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->default('');
            $table->string('otp')->default('');
            $table->string('last_name')->default('');
            $table->string('middle_name')->default('');
            $table->string('email')->unique()->notNullable();
            $table->string('password')->notNullable();
            $table->string('mobile')->default('');
            $table->string('contact')->default('');
            $table->string('fb_id')->default('');
            $table->string('act_code')->default('');
            $table->integer('status')->default(0);
            $table->string('token')->default('');
            $table->string('agent')->default('');

          

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
        Schema::dropIfExists('users');
    }
}
