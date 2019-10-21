<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workingDays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('userDate');
            $table->boolean('available');
            $table->boolean('officailTime');
            $table->string('startTime');
            $table->string('endTime');
            $table->unsignedBigInteger('userId')->nullable();
            $table->foreign('userId')
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
        Schema::dropIfExists('workingDays');
    }
}
