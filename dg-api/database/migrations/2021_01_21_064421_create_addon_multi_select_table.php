<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonMultiSelectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addon_multi_select', function (Blueprint $table) {
            $table->id();
            $table->string('addoncatid');
            $table->string('menuid');
            $table->string('hotelid');
            $table->string('count');
            $table->string('add_on_desc');
            $table->string('status');
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
        Schema::dropIfExists('addon_multi_select');
    }
}
