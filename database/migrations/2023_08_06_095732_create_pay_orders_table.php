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
        Schema::create('pay_orders', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('order_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('status');
            $table->string('message_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_orders');
    }
};
