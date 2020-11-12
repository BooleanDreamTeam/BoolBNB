<?php

use Illuminate\Database\Seeder;
use App\UserType;

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
