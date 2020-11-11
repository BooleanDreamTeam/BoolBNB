<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;
use Faker\Generator as Faker;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i <= 2 ; $i++) {
            $sponsor = new Sponsorship;
            $sponsor->name = $faker->colorName();
            $sponsor->price = $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100);
            $sponsor->time = $faker->numberBetween($min = 0, $max = 124);
            $sponsor->save();
        }
    }
}
