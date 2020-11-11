<?php

use Illuminate\Database\Seeder;
use App\UserDetail;
use Faker\Generator as Faker;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $details = new UserDetail;
            $details->birth_date = $faker->dateTime();
            $details->address = $faker->streetAddress();
            $details->phone_n = $faker->phoneNumber();
            $details->avatar = $faker->imageUrl();
            $details->save();
        }
    }
}
