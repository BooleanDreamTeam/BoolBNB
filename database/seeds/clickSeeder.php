<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Click;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

class ClickSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $browser = [
            'Internet Explorer',
			'Firefox',
			'Safari',
			'Chrome',
			'Edge',
			'Opera',
			'Netscape'
        ];
        $regions = [
            'Abruzzo',
            'Valle d\'Aosta',
            'Puglia',
            'Basilicata',
            'Calabria',
            'Campania',
            'Emilia-Romagna',
            'Friuli Venezia Giulia',
            'Lazio',
            'Liguria',
            'Lombardia',
            'Marche',
            'Molise',
            'Piemonte',
            'Sardegna',
            'Sicilia',
            'Trentino-Alto-Adige',
            'Toscana',
            'Umbria',
            'Veneto'
        ];
        $apartments = Apartment::all();
        for ($i=0; $i < 1000; $i++) {
            $clickNew = new Click;
            $clickNew->id_apartment = $apartments->random()->id;
            $clickNew->browser = Arr::random($browser);
            $clickNew->geo_area = Arr::random($regions);
            $clickNew->visitor = $faker->ipv4;
            $clickNew->created_at = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
            $clickNew->save();
        }
    }
}
