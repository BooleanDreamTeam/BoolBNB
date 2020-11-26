<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;
use App\Apartment;
use Illuminate\Support\Facades\DB;
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

        for ($i = 0; $i < 10; $i++){
            $apartment = Apartment::all()->random();
            $sponsor = Sponsorship::all()->random();
            $now = Carbon\Carbon::now();

            DB::table('apartment_sponsorship')->insert(
                [
                    [
                        'sponsorship_id' => $sponsor->id,
                        'apartment_id' => $apartment->id,
                        'created_at' => $now,
                        'started_at' => $now,
                        'expiration_date' => $now->clone()->addDays($faker->numberBetween(7, 20))   // faccio il clone di $now in modo da 
                                                                                                    // lasciare intatto il punto di partenza al 
                                                                                                    // quale aggiungere in seguito i giorni
                    ]
                ]
            );
        }
    }

    
}
