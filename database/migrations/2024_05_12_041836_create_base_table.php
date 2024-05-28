<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base', function (Blueprint $table) {
            $table->id('id_base');
            $table->text('base')->nullable();
            $table->text('pict_bs')->nullable();
            $table->text('deskripsi_bs')->nullable();
            $table->text('harga_bs')->nullable();
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
        Schema::dropIfExists('base');
    }
}
