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
			'Internet Explorer',
			'Firefox',
			'Safari',
			'Chrome',
			'Edge',
			'Opera',
			'Netscape',
			'Maxthon',
			'Konqueror',
			'UC Browser',
			'Handheld Browser'
        ];
        $regions = [
            'Abruzzo',
            'Aosta Valley',
            'Valle d\'Aosta',
            'Apulia',
            'Basilicata',
            'Calabria',
            'Campania',
            'Emilia-Romagna',
            'Friuli Venezia Giulia',
            'Lazio',
            'Liguria',
            'Lombardy',
            'Marche',
            'Molise',
            'Piedmont',
            'Sardinia',
            'Sicily',
            'Trentino-South Tyrol',
            'Tuscany',
            'Umbria',
            'Veneto'
        ];
        $apartments = Apartment::all();
        for ($i=0; $i < 1000; $i++) {
            $clickNew = new Click;
            $clickNew->id_apartment = $apartments->random()->id;
            $clickNew->browser = Arr::random($browser);
            $clickNew->geo_area = Arr::random($region);
            $clickNew->visitor = $faker->ipv4;
            $clickNew->created_at = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
            $clickNew->save();
        }
    }
}
