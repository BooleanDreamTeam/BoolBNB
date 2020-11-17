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

        for ($i=0; $i < count($apartments) - 1; $i++) 
        {   
      
            for($j=0; $j < 4; $j++)
            {   
                $imageNew = new Image;
                $imageNew->apartment_id = $i + 1;
                if ($j == 0){       
                    $imageNew->cover = true;
                    $imageNew->imgurl = 'https://picsum.photos/300/300?random='. $i . $j;
                    $imageNew->save();

                }else{
                    $imageNew->cover = false;
                    $imageNew->imgurl = 'https://picsum.photos/300/300?random='. $i . $j;
                    $imageNew->save();
                }

            }
        }
    }
}
