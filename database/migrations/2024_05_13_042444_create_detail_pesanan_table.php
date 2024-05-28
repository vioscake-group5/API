<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->Id('id_psn');
            $table->foreignId('id_kue')->nullable()->references('id_kue')->on('kue')->onDelete('cascade');
            $table->foreignId('id_base')->nullable()->references('id_base')->on('base')->onDelete('cascade');
            $table->foreignId('id_ukuran')->nullable()->references('id_ukuran')->on('ukuran')->onDelete('cascade');
            $table->foreignId('id_desain')->nullable()->references('id_desain')->on('desain')->onDelete('cascade');
            $table->foreignId('id_topping')->nullable()->references('id_topping')->on('topping')->onDelete('cascade');
            $table->foreignId('id_ds_t')->nullable()->references('id_ds_t')->on('desain_t')->onDelete('cascade');
            $table->foreignId('id_pesanan')->nullable()->references('id_pesanan')->on('pesanan')->onDelete('cascade');
            $table->foreignId('id_pembayaran')->nullable()->references('id_pembayaran')->on('pembayaran')->onDelete('cascade');
            $table->foreignId('id_keranjang')->nullable()->references('id_keranjang')->on('keranjang')->onDelete('cascade');
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
        Schema::dropIfExists('detail_pesanan');
    }
}
