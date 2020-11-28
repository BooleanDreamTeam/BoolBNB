<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $name_a = ['Villa', 'Casa', 'Residenza', 'Appartamento', 'B&B', 'Borgo', 'Casale'];
        $name_b = ['Amodio', 'Zavaglia', 'Meleqi', 'Santoro', 'Scollo', 'del duca', 'del conte', 'del sole', 'belvedere', 'del principe', 'Roma', 'Milano', 'sul mare', 'sul monte', 'sulla collina', 'Napoli', 'Cosenza', 'Palmi', 'Messina', 'Varese', 'Ragusa'];

        $users = User::all();

        for ($i=0; $i < 200; $i++) {
            $apartment = new Apartment;
            $apartment->title = Arr::random($name_a) . ' ' . Arr::random($name_b);
            $apartment->description = $faker->text($maxNbChars = 2000)   ;
            $apartment->n_rooms = $faker->numberBetween(1, 6);
            $apartment->n_beds = $faker->numberBetween(1, 6);
            $apartment->n_bathrooms = $faker->numberBetween(1, 4);
            $apartment->squaremeters = $faker->numberBetween(50, 400);
            $apartment->address = $faker->address();
            $apartment->latitude = $faker->randomFloat($nbMaxDecimals = 4, $min = 38, $max = 40);
            $apartment->longitude = $faker->randomFloat($nbMaxDecimals = 4, $min = 15, $max = 17);
            $apartment->is_active = $faker->boolean();
            $apartment->created_at = now();
            $apartment->updated_at = now();
            $apartment->host_id = $users->random()->id;
            $apartment->save();
        }
    }
}
