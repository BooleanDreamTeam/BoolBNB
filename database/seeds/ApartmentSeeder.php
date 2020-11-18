<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\User;
use Faker\Generator as Faker;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $users = User::all();

        for ($i=0; $i < 30; $i++) {
            $apartment = new Apartment;
            $apartment->title = $faker->word.' '.$faker->word;
            $apartment->description = $faker->sentence();
            $apartment->n_rooms = $faker->numberBetween(1, 6);
            $apartment->n_beds = $faker->numberBetween(1, 6);
            $apartment->n_bathrooms = $faker->numberBetween(1, 4);
            $apartment->squaremeters = $faker->numberBetween(50, 400);
            $apartment->address = $faker->address();
            $apartment->latitude = $faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 999);
            $apartment->longitude = $faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 999);
            $apartment->is_active = $faker->boolean();
            $apartment->created_at = now();
            $apartment->updated_at = now();
            $apartment->host_id = $users->random()->id;
            $apartment->save();
        }
    }
}
