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
        $price = [
            2.99,
            5.99,
            9.99
        ];

        $time = [
            24,
            72,
            144
        ];

        $plan = [
            'silver',
            'gold',
            'platinum'
        ];

        for ($i=0; $i < count($price); $i++) {
            $sponsor = new Sponsorship;
            $sponsor->name = $plan[$i];
            $sponsor->price = $price[$i];
            $sponsor->time = $time[$i];
            $sponsor->save();
        }
    }
}
