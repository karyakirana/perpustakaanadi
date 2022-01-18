<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeminjamanIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman_buku_detail', function (Blueprint $table) {
            $table->unsignedBigInteger('peminjaman_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjaman_buku_detail', function (Blueprint $table) {
            $table->dropColumn('peminjaman_id');
        });
    }
}
