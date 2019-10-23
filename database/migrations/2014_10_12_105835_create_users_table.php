<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userName');
            $table->string('userEmail')->unique();
            $table->string('userPassword');
            $table->string('userMobile')->nullable();
            $table->string('userPhone')->nullable();
            $table->string('userIdNum')->nullable();
            $table->string('userIdFile')->nullable();
            $table->string('userJopTitle')->nullable();
            $table->string('userAddress')->nullable();
            $table->unsignedBigInteger('roleId');
            $table->foreign('roleId')
            ->references('id')
            ->on('roles')
            ->onDelete('cascade');

            $table->unsignedBigInteger('officeId')->nullable();
            $table->foreign('officeId')
            ->references('id')
            ->on('offices')
            ->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('cityId')->nullable();
            $table->foreign('cityId')
            ->references('id')
            ->on('cities')
            ->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
