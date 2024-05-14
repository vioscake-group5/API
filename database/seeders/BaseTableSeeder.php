<?php

namespace Database\Seeders;

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
        

        \DB::table('base')->delete();
        
        
        
    }
}