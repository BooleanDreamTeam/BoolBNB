<?php

use Illuminate\Database\Seeder;
use App\Apartment;
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
        for ($i=0; $i < 10; $i++) {
            $apartment = new Apartment;
            $apartment->title = $faker->sentence();
            $apartment->n_rooms = $faker->numberBetween(1, 6);
            $apartment->n_beds = $faker->numberBetween(1, 6);
            $apartment->n_bathrooms = $faker->numberBetween(1, 4);
            $apartment->squaremeters = $faker->numberBetween(50, 400);
            $apartment->latitude = $faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 999);
            $apartment->longitude = $faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = 999);
            $apartment->is_active = $faker->boolean();
            $apartment->created_at = now();
            $apartment->updated_at = now();
            $apartment->host_id = 2;
            $apartment->save();
        }
    }
}
