<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostBestbyWastedColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('food', function($table) {
            $table->tinyInteger('past_expired');
            $table->date('user_best_by_date');
            $table->tinyInteger('wasted_before_expiration');
            $table->string('cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food', function($table) {
            $table->dropColumn('past_expired');
            $table->dropColumn('user_best_by_date');
            $table->dropColumn('wasted_before_expiration');
            $table->dropColumn('cost');
        });
    }
}
