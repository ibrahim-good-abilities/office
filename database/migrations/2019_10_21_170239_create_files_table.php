<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fileUrl');
            $table->unsignedBigInteger('requirementId')->nullable();
            $table->foreign('requirementId')
            ->references('id')
            ->on('requirements')
            ->onDelete('cascade');

            $table->unsignedBigInteger('ticketId')->nullable();
            $table->foreign('ticketId')
            ->references('id')
            ->on('tickets')
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
        Schema::dropIfExists('files');
    }
}
