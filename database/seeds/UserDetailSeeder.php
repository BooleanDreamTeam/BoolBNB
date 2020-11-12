<?php

use Illuminate\Database\Seeder;
use App\UserDetail;
use App\User;
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
        $users = User::all();

        for ($i=0; $i < count($users); $i++) {
            $details = new UserDetail;
            $details->user_id = $i + 1 ;
            $details->birth_date = $faker->dateTime();
            $details->address = $faker->streetAddress();
            $details->phone_n = $faker->phoneNumber();
            $details->avatar = $faker->imageUrl();
            $details->save();
        }
    }
}
