<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('folder_name',256)->nullable();
            $table->timestamps();
            $table->foreign('parent_id')
                    ->references('id')->on('folders')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('_folders');
    }
}
