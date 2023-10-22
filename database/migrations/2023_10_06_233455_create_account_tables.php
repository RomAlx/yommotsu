<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_web', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->unsignedBigInteger('token_id')->nullable();
            $table->timestamps();
        });
        

        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->string('access_token');
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts_web')->onDelete('cascade');
        });

        Schema::create('account_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->string('name');
            $table->string('role');
            $table->string('project_name');
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts_web')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_info');
        Schema::dropIfExists('tokens');
        Schema::dropIfExists('accounts_web');
    }
}
