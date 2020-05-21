<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_id',50)->unique();
            $table->string('name',256)->nullable();
            $table->string('file_number',256)->nullable();
            $table->string('country',256)->nullable();
            $table->string('district',256)->nullable();
            $table->string('city',256)->nullable();
            $table->string('address',512)->nullable();
            $table->string('postcode',30)->nullable();
            $table->string('email',50)->nullable();
            $table->string('phone_no',50)->nullable();

            $table->string('reg_no_online',100)->nullable();
            $table->string('reg_no_manual',100)->nullable();
            $table->date('reg_date')->nullable();
            $table->string('reg_user_name',100)->nullable();
            $table->string('reg_password',50)->nullable();
            $table->string('reg_email',50)->nullable();
            


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
        Schema::dropIfExists('companies');
    }
}
