<?php

use Illuminate\Database\Seeder;
use App\Review;
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
        for ($i=0; $i < 10; $i++) {
            $review = new Review;
            $review->id_apartment = 3;
            $review->name = $faker->name();
            $review->message = $faker->text();
            $review->vote = $faker->numberBetween($min = 0, $max = 5);
            $review->created_at = now();
            $review->save();
        }
    }
}