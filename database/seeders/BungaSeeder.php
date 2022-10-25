<?php

namespace Database\Seeders;

use App\Models\Bunga;
use Illuminate\Database\Seeder;

class BungaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bunga::create(['suku_bunga'=>2]);
    }
}
