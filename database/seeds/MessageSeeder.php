<?php

use Illuminate\Database\Seeder;
use App\Message;
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
        for ($i=0; $i < 10; $i++) {
            $message = new Message;
            $message->message = $faker->text();
            $message->apartment_id = 3;
            $message->email = $faker->email();
            $message->created_at = now();
            $message->save();
        }
    }
}
