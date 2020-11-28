<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\Apartment;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $apartments = Apartment::all();

        for ($i=0; $i < 100; $i++) {
            $message = new Message;
            $message->message = $faker->text();
            $message->apartment_id = $apartments->random()->id;
            $message->email = $faker->email();
            $message->created_at = now();
            $message->save();
        }
    }
}
