<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalian_buku', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengembalian')->unique();
            $table->unsignedBigInteger('peminjam');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('total_bayar')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalian_buku');
    }
}
