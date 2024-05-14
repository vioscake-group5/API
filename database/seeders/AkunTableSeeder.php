<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Db;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Akun;

class AkunTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('akun')->insert([
            'email' => 'vioscake1@gmail.com',
            'password' => Hash::make('vios1234'),
            'nama' => 'Admin_Vioscake',
            'no_telp' => '08112222334',
            'level_akun' => '1',
            'remember_token' => Str::random(10)
        ]);

        DB::table('akun')->insert([
            'email' => 'dimasok025@gmail.com',
            'password' => Hash::make('1111'),
            'nama' => 'Dimas',
            'no_telp' => '08112222333',
            'level_akun' => '2',
            'remember_token' => Str::random(10)
        ]);
        
        
    }
}