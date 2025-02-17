<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
        * Run the migrations.
        *
        * @return void
        */
        public function up()
        {
            Schema::table('pay_orders', function (Blueprint $table) {
                $table->integer('rate')->nullable();
                $table->string('comment')->nullable();
            });
        }
 
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('pay_orders', function (Blueprint $table) {
                $table->dropColumn('rate');
                $table->dropColumn('comment');
            });
        }
};
