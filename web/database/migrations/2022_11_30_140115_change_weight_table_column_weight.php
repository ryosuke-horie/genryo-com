<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWeightTableColumnWeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 型を変更
        Schema::table('weight', function (Blueprint $table) {
            $table->decimal('weight', $precision = 5, $scale = 2)->default(NULL)->change();
        });
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
