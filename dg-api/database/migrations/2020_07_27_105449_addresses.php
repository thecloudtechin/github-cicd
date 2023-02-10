<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class Addresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('u_id');
            $table->string('home_address')->default('');
            $table->string('permanent_address')->default('');
            $table->string('pincode')->default('');
            $table->string('city')->default('');
            $table->integer('status')->default(0);
            $table->string('state')->default('');
            $table->string('landmark')->default('');
            $table->string('name')->default('');
            $table->string('contact')->default('');
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
        Schema::dropIfExists('addresses');
    }
}