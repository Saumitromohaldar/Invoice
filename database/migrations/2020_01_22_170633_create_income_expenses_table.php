<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('category_id');
            $table->float('amount');
            $table->string('note',256)->nullable();            
            $table->string('type',20);     
            $table->date('date')->nullable();            
            $table->timestamps();
            // $table->foreign('category_id')
            //         ->references('id')->on('categories')
            //         ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_expenses');
    }
}
