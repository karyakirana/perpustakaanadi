<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPerubahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_perubahan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis'); // stock masuk atau stock keluar baik baru maupun lama
            $table->date('tgl_perubahan');
            $table->unsignedBigInteger('pembuat');
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
        Schema::dropIfExists('stock_perubahan');
    }
}
