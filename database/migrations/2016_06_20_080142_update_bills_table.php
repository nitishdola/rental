<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->integer('number_of_electricity_unit')->nullable();
            $table->enum('paid', array('paid', 'unpaid'))->default('unpaid');
            $table->integer('bill_type_id', false, true);
            $table->foreign('bill_type_id')->references('id')->on('bill_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bills', function (Blueprint $table) {
            //
        });
    }
}
