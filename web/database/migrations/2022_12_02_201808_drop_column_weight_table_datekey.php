<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnWeightTableDatekey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 一度実行したら次からはエラーになるので修正。
        // Schema::table('weight', function (Blueprint $table) {
        //     $table->dropColumn('date_key');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weight', function (Blueprint $table) {
            //
        });
    }
}
