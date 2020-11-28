<?php

use Illuminate\Database\Seeder;
use App\Review;
use App\Apartment;
use Faker\Generator as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $apartments = Apartment::all();

        for ($i=0; $i < 500; $i++) {
            $review = new Review;
            $review->id_apartment = $apartments->random()->id;
            $review->name = $faker->name();
            $review->message = $faker->text();
            $review->vote = $faker->numberBetween($min = 1, $max = 5);
            $review->created_at = now();
            $review->save();
        }
    }
}
