<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
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
            $table->string('invoice_id',50)->unique();
            $table->unsignedBigInteger('company_id');
            $table->float('invoice_total')->nullable();

            $table->float('invoice_subtotal')->nullable();
            $table->float('vat')->nullable();
            $table->float('tax_percent')->nullable();

            $table->float('discount')->nullable();
            $table->float('amount_paid')->nullable();
            $table->float('amount_due')->nullable();
            $table->string('designation',512)->nullable();
            $table->string('name',512)->nullable();
            $table->string('address',512)->nullable();
            $table->string('country',256)->nullable();
            $table->string('district',256)->nullable();
            $table->string('city',256)->nullable();

            $table->string('postcode',30)->nullable();
            $table->string('email',50)->nullable();
            $table->string('phone_no',50)->nullable();

            $table->text('notes')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('mail_send')->nullable();
            $table->timestamps();
            $table->foreign('company_id')
                    ->references('id')->on('companies')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
