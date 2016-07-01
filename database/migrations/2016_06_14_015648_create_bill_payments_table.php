<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('renter_id');
            $table->decimal('rent', 10,2);
            $table->decimal('total_payble', 10,2);
            $table->date('monthyear');
            $table->enum('paid', ['yes', 'no'])->default('no');
            $table->date('pay_date');
            $table->string('cheque_number')->nullable();
            $table->date('cheque_date')->nullable();
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
        Schema::drop('bill_payments');
    }
}
