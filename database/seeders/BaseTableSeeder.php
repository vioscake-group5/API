<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Db;
use Illuminate\Database\Seeder;

class BaseTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {       

        DB::table('base')->insert(
            [
                'base' => 'vanila',
                'pict_bs' => 'vanila.png',
                'deskripsi_bs' => 'enak',
                'harga_bs' => '12000',
            ]);
            DB::table('base')->insert(
            [
                'base' => 'chocolate',
                'pict_bs' => 'chocolate.png',
                'deskripsi_bs' => 'lezat',
                'harga_bs' => '15000',
            ]);
            DB::table('base')->insert(
            [
                'base' => 'strawberry',
                'pict_bs' => 'strawberry.png',
                'deskripsi_bs' => 'manis',
                'harga_bs' => '13000',
            ]);
            DB::table('base')->insert(
            [
                'base' => 'matcha',
                'pict_bs' => 'matcha.png',
                'deskripsi_bs' => 'unik',
                'harga_bs' => '14000',
            ]);
            DB::table('base')->insert(
            [
                'base' => 'coffee',
                'pict_bs' => 'coffee.png',
                'deskripsi_bs' => 'kaya rasa',
                'harga_bs' => '16000',
            ]);
            DB::table('base')->insert(
            [
                'base' => 'caramel',
                'pict_bs' => 'caramel.png',
                'deskripsi_bs' => 'manis',
                'harga_bs' => '15000',
            ]);
            DB::table('base')->insert(
            [
                'base' => 'mango',
                'pict_bs' => 'mango.png',
                'deskripsi_bs' => 'segar',
                'harga_bs' => '14000',
            ],
        );
    }
}