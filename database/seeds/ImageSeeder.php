<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::all();

        for ($i=0; $i < count($apartments); $i++) 
        {   
      
            for($j=0; $j < 4; $j++)
            {   
                $imageNew = new Image;
                $imageNew->apartment_id = $i + 1;
                if ($j == 0){       
                    $imageNew->cover = true;
                    $imageNew->imgurl = '/storage/apartments/bool_'. rand(1, 99).'.jpg';
                    $imageNew->save();

                }else{
                    $imageNew->cover = false;
                    $imageNew->imgurl = '/storage/apartments/bool_'. rand(1, 99) . '.jpg';
                    $imageNew->save();
                }

            }
        }
    }
}
