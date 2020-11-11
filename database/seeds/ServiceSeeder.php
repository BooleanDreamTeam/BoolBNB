<?php

use Illuminate\Database\Seeder;
use App\Service;
use Faker\Generator as Faker;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $service = new Service;
            $service->name = $faker->word();
            $service->save();
        }
    }
}
