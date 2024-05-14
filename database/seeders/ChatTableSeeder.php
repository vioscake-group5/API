<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('chat')->delete();
        
        
        
    }
}