<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KueTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kue')->delete();
        
        
        
    }
}