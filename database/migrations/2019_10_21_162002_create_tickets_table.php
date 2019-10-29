<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticketStatus');
            $table->string('ticketEndTime');
            $table->unsignedBigInteger('userId')->nullable();
            $table->foreign('userId')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->unsignedBigInteger('scheduleId')->nullable();
            $table->foreign('scheduleId')
            ->references('id')
            ->on('schedule')
            ->onDelete('cascade');

            $table->unsignedBigInteger('serviceId');
            $table->foreign('serviceId')
            ->references('id')
            ->on('services')
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
        Schema::dropIfExists('tickets');
    }
}
