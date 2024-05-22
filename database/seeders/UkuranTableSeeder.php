<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Db;


class UkuranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ukuran')->insert(
            [
                'ukuran' => '10cm',
                'harga_uk' => '12000',
            ]);
        DB::table('ukuran')->insert(
            [
                'ukuran' => '15cm',
                'harga_uk' => '15000',
            ]);
        DB::table('ukuran')->insert(
            [
                'ukuran' => '20cm',
                'harga_uk' => '20000',
            ]);
        DB::table('ukuran')->insert(
            [
                'ukuran' => '25cm',
                'harga_uk' => '25000',
            ]);
        DB::table('ukuran')->insert(
            [
                'ukuran' => '30cm',
                'harga_uk' => '30000',
            ]);
        DB::table('ukuran')->insert(
            [
                'ukuran' => '35cm',
                'harga_uk' => '35000',
            ],
        );
    }
}
