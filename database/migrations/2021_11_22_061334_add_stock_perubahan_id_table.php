<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockPerubahanIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_perubahan_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('stock_perubahan_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_perubahan_detail', function (Blueprint $table) {
            $table->dropColumn('stock_perubahan_id');
        });
    }
}
