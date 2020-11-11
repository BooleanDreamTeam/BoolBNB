<?php

use Illuminate\Database\Seeder;

class usertypeSeeder extends Seeder
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
                $usertypeNew = new userType;
                $usertypeNew->name = $type[$i];
                $usertypeNew->save();
              }
        }
    }
}
