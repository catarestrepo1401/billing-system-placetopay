<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('document_number');
            $table->bigInteger('document_type');
            $table->dateTime('expired_at');
            $table->dateTime('delivery_at');
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount_rate', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('net', 12, 2)->default(0);
            $table->decimal('tax_rate', 12, 2)->default(0);
            $table->decimal('tax', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('invoices');
    }
}
