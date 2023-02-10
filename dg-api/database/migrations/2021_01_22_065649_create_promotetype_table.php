<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotetypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotetype', function (Blueprint $table) {
            $table->id();
            $table->string('hotelid');
            $table->string('promote_title');
            $table->string('promote_desc');
            $table->string('cost');
            $table->string('from_date');
            $table->string('end_date');
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
        Schema::dropIfExists('promotetype');
    }
}
