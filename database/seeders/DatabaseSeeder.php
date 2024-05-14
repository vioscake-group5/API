<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AkunTableSeeder::class);
        $this->call(AlamatTableSeeder::class);
        $this->call(BaseTableSeeder::class);
        $this->call(ChatTableSeeder::class);
        $this->call(DesainTableSeeder::class);
        $this->call(DesainTTableSeeder::class);
        $this->call(DetailPesananTableSeeder::class);
        $this->call(KueTableSeeder::class);
    }
}
