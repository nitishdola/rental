<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_type_id', false, true);
            $table->date('period_from')->description('Eletricity Meter Period From');
            $table->date('period_to')->description('Eletricity Meter Period To');
            $table->integer('renter_id', false, true);
            $table->integer('current_meter_reading', false, true);
            $table->integer('previous_meter_reading', false, true);
            $table->decimal('bill_amount', 10, 2);
            $table->enum('paid', array('paid', 'unpaid'))->default('unpaid');
            $table->timestamps();

            $table->foreign('bill_type_id')->references('id')->on('bill_types');
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
        Schema::drop('bills');
    }
}
