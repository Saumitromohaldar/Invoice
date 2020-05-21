<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('official_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('folder_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('title',256)->nullable();
            $table->string('file_name',512)->nullable();
            $table->string('file_type',512)->nullable();
            $table->timestamps();
            $table->foreign('folder_id')
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
        Schema::dropIfExists('official_documents');
    }
}
