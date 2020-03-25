<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['approved', 'pending', 'rejected', 'failed']);
            $table->string('identifier')->unique()->nullable();
            $table->enum('method', ['place_to_pay', 'debit_card', 'credit_card', 'cash', 'bank_payment', 'pse', 'pay_fees', 'bank_check', 'electronic_transfer', 'credit_note']);
            $table->decimal('amount', 12, 2)->default(0);

            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('customer_id');

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('payments');
    }
}