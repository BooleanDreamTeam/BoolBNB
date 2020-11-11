<?php

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
        $this->call([
            UserDetailSeeder::class,
            UserSeeder::class,
            ApartmentSeeder::class,
            ServiceSeeder::class,
            MessageSeeder::class
        ]);
    }
}
