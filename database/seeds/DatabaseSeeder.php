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
            UserTypeSeeder::class,
            UserSeeder::class,
            UserDetailSeeder::class,
            ApartmentSeeder::class,
            MessageSeeder::class,
            SponsorshipSeeder::class,
            ClickSeeder::class,
            ServiceSeeder::class,
            ReviewSeeder::class,
            ImageSeeder::class
        ]);
    }
}
