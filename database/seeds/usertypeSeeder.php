<?php

use Illuminate\Database\Seeder;
use App\UserType;
use Faker\Generator as Faker;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {   
            $type = [
              'User',
              'Host'
            ];
    
            for ($i=0; $i < count($type); $i++) {
                $usertypeNew = new UserType;
                $usertypeNew->name = $type[$i];
                $usertypeNew->save();
            }
        }
    }
}
