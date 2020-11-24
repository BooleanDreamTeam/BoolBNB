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
        $serv = [
            'Parcheggio',
            'WiFi',
            'Animali ammessi',
            'Palestra',
            'Navetta aeroportuale',
            'Piscina',
            'Spa',
            'Cucina/Angolo cottura',
            'Aria condizionata',
            'TV satellitare'
          ];
        for ($i=0; $i < count($serv); $i++) {
            $service = new Service;
            $service->name = $serv[$i];
            $service->save();
        }
    }
}
