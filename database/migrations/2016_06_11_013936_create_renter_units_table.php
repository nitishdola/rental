<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenterUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renter_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id', false, true);
            $table->integer('renter_id', false, true);
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('renter_id')->references('id')->on('renters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('renter_units');
    }
}
