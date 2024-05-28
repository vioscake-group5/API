<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Db;

class KueTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('kue')->insert([
            'id_base' => '1',
            'id_ukuran' => '1',
            'id_desain' => '1',
        ]);
        DB::table('kue')->insert([
            'id_base' => '2',
            'id_ukuran' => '2',
            'id_desain' => '2',
        ]);
        DB::table('kue')->insert([
            'id_base' => '3',
            'id_ukuran' => '3',
            'id_desain' => '3',
        ]);
        DB::table('kue')->insert([
            'id_base' => '4',
            'id_ukuran' => '4',
            'id_desain' => '4',
        ]);
        DB::table('kue')->insert([
            'id_base' => '5',
            'id_ukuran' => '5',
            'id_desain' => '5',
        ]);
        DB::table('kue')->insert([
            'id_base' => '6',
            'id_ukuran' => '6',
            'id_desain' => '6',
        ]);
        DB::table('kue')->insert([
            'id_base' => '1',
            'id_ukuran' => '2',
            'id_desain' => '2',
        ]);
        DB::table('kue')->insert([
            'id_base' => '2',
            'id_ukuran' => '3',
            'id_desain' => '3',
        ]);
        DB::table('kue')->insert([
            'id_base' => '3',
            'id_ukuran' => '4',
            'id_desain' => '4',
        ]);
        DB::table('kue')->insert([
            'id_base' => '4',
            'id_ukuran' => '5',
            'id_desain' => '5',
        ]);
        DB::table('kue')->insert([
            'id_base' => '5',
            'id_ukuran' => '6',
            'id_desain' => '6',
        ]);
        DB::table('kue')->insert([
            'id_base' => '6',
            'id_ukuran' => '3',
            'id_desain' => '3',
        ]);
        DB::table('kue')->insert([
            'id_base' => '7',
            'id_ukuran' => '4',
            'id_desain' => '4',
        ]);

    }
}