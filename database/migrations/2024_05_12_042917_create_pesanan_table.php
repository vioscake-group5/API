<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->dateTime('waktu_toID')->nullable();
            $table->date('tanggal_pemesanan')->nullable();
            $table->date('tanggal_ambil')->nullable();
            $table->timestamp('tanggal')->nullable();
            $table->enum('status', ['menunggu konfirmasi', 'menunggu pembayaran', 'kue dibuat', 'selesai']);
            $table->foreignId('id_akun')->references('id_akun')->on('akun')->onDelete('cascade');
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
        Schema::dropIfExists('pesanan');
    }
}
