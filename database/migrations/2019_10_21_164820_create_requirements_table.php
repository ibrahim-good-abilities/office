<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('requirementName');
            $table->string('requirementDescription')->nullable();
            $table->string('requirementType');
            $table->unsignedBigInteger('serviceId')->nullable();
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
        Schema::dropIfExists('requirements');
    }
}
