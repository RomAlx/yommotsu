<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_exchanges', function (Blueprint $table) {
            $table->id();
            $table->string('telegram_id');
            $table->string('buy')->nullable();
            $table->string('sell')->nullable();
            $table->string('amount')->nullable();
            $table->string('location')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('isCorrect')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_exchanges');
    }
};
