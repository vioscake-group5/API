<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kue', function (Blueprint $table) {
            $table->id('id_kue');
            $table->foreignId('id_base')->references('id_base')->on('base')->onDelete('cascade');
            $table->foreignId('id_ukuran')->references('id_ukuran')->on('ukuran')->onDelete('cascade');
            $table->foreignId('id_desain')->references('id_desain')->on('desain')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kue');
    }
}
