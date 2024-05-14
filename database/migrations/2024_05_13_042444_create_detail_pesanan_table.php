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
            $table->foreignId('id_kue')->references('id_kue')->on('kue')->onDelete('cascade');
            $table->foreignId('id_topping')->references('id_topping')->on('topping')->onDelete('cascade');
            $table->foreignId('id_ds_t')->references('id_ds_t')->on('desain_t')->onDelete('cascade');
            $table->foreignId('id_pesanan')->references('id_pesanan')->on('pesanan')->onDelete('cascade');
            $table->foreignId('id_pembayaran')->references('id_pembayaran')->on('pembayaran')->onDelete('cascade');
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
