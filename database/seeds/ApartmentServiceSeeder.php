<?php

use Illuminate\Database\Seeder;
use App\Apartment;
use App\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::all();
        $services = Service::all();

        for($i = 1; $i < count($apartments); $i++){

            $numbers = range(1, count($services));
            shuffle($numbers);
            $numbers = array_slice($numbers, 0, 3);

            DB::table('apartment_service')->insert(array(
                array('apartment_id' => $i, 'service_id' => $numbers[0]),
                array('apartment_id' => $i, 'service_id' => $numbers[1]),
                array('apartment_id' => $i, 'service_id' => $numbers[2]),
            ));
        }
    }
}
