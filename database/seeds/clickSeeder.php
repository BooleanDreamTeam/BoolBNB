<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Click;
use Faker\Generator as Faker;

class ClickSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $apartments = Apartment::all();
        for ($i=0; $i < 200; $i++) {
            $clickNew = new Click;
            $clickNew->id_apartment = $apartments->random()->id;
            $clickNew->browser = $faker->userAgent;
            $clickNew->geo_area = $faker->state;
            $clickNew->visitor = $faker->ipv4;
            $clickNew->created_at = $faker->date($format = 'Y-m-d', $max = 'now').' '.$faker->time($format = 'H:i:s', $max = 'now');
            $clickNew->save();
        }
    }
}
