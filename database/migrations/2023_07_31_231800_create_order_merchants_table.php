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
        Schema::create('order_merchants', function (Blueprint $table) {
            $table->id();
            $table->string('telegram_id');
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
        Schema::dropIfExists('order_merchants');
    }
};
