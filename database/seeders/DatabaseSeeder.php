<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Seeds\{DistrictsSeeder, CitiesSeeder, VillagesSeeder, ProvincesSeeder};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ProvincesSeeder::class,
            CitiesSeeder::class,
            DistrictsSeeder::class,
            VillagesSeeder::class,
            BungaSeeder::class,
            PinjamanSeeder::class,
        ]);
    }
}
