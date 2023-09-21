<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_merchants', function (Blueprint $table) {
            $table->string('connect')->after('name')->nullable();
            $table->string('link')->after('phone')->nullable();
            $table->text('description')->after('link')->nullable();
        });
    }

    public function down()
    {
        Schema::table('order_merchants', function (Blueprint $table) {
            $table->dropColumn(['connect', 'link', 'description']);
        });
    }
};
