<?php

use Illuminate\Database\Seeder;
use App\Click;
use App\Apartment;
use Faker\Generator as Faker;

class clickSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $clickNew = new Click;
            $clickNew->id_apartment = $apartments->random()->id;
            $clickNew->browser = $faker->userAgent;
            $clickNew->geoarea = $faker->state;
            $clickNew->ipAddress = $faker->ipv4;
            $clickNew->date = $faker->date($format = 'Y-m-d', $max = 'now').time($format = 'H:i:s', $max = 'now');
            $clickNew->save();
        }
    }
}
