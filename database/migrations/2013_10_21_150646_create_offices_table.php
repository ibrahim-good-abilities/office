<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('officeName');
            $table->string('officeAddress')->nullable();
            $table->string('officePhone')->nullable();
            $table->string('officeMobile')->nullable();
            $table->string('officeEmail')->nullable();
            $table->unsignedBigInteger('cityId')->nullable();
            $table->foreign('cityId')
            ->references('id')
            ->on('cities')
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
        Schema::dropIfExists('offices');
    }
}
