<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name');
            $table->longText('item_desc');
            $table->bigInteger('categories_id')->default(0);
            // $table->bigInteger('qty');
            $table->bigInteger('price')->default(0);
            $table->integer('status')->default(0);
            $table->integer('discount')->default(0);
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
