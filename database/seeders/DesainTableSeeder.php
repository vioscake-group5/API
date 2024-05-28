<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Db;

class DesainTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('desain')->insert(
            [
                'desain' => 'desain1',
                'pict_ds' => 'desain1.png',
                'harga_ds' => '10000',
            ]);
        DB::table('desain')->insert(
            [
                'desain' => 'desain2',
                'pict_ds' => 'desain2.png',
                'harga_ds' => '12000',
            ]);
        DB::table('desain')->insert(
            [
                'desain' => 'desain3',
                'pict_ds' => 'desain3.png',
                'harga_ds' => '15000',
            ]);
        DB::table('desain')->insert(
            [
                'desain' => 'desain4',
                'pict_ds' => 'desain4.png',
                'harga_ds' => '13000',
            ]);
        DB::table('desain')->insert(
            [
                'desain' => 'desain5',
                'pict_ds' => 'desain5.png',
                'harga_ds' => '14000',
            ]);
        DB::table('desain')->insert(
            [
                'desain' => 'desain6',
                'pict_ds' => 'desain6.png',
                'harga_ds' => '16000',
            ],
        );
    }
}