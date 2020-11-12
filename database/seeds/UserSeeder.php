<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserType;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $usertypes = UserType::all();
        for ($i=0; $i < 10; $i++) {
            $user = new User;
            $user->name = $faker->name();
            $user->user_type_id = $usertypes->random()->id;
            $user->email = $faker->email();
            $user->password = $faker->sha256();
            $user->save();
        }
    }
}
