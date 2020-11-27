<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Apartment;
use App\Sponsorship;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Apartment::get(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255',
            'n_rooms' => 'required|min:1|max:4',
            'n_beds' => 'required|min:1|max:4',
            'n_bathrooms' => 'required|min:1|max:4',
            'squaremeters' => 'required|min:1|max:6',
            'latitude' => 'required',
            'longitude' => 'required',
            'is_active' => 'required',
            'host_id' => 'numeric|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['Messaggio' => 'errore inserimento!']);
        }

        $apartment = Apartment::create($request->all());

        return response()->json($apartment,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Apartment::select(DB::raw("
          images.imgurl, apartments.*
        "))
        ->join('images','images.apartment_id','=','apartments.id')
        ->where('apartments.id',$id)
        ->get(),200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        return response()->json(['Response:' => $apartment->update($request->all()), 'apartment' => $apartment],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return response()->json(['Messaggio' => "l'appartamento con id:$apartment->id è stato cancellato correttamente!"]);
    }

    public function searching(Request $request)
    {       
        $n_rooms = $request['stanze'];
        $services = $request['services'];
        $n_beds = $request['postiletto'];
        $range = $request['range'];
        $address = $request['address'];
        $cordinates = $request['cordinates'];

        $arrayCordinates = explode(",", $cordinates);

        $lat = $arrayCordinates[0];
        $lng = $arrayCordinates[1];

        $queryApartment = Apartment::query();

        $queryApartment->where('n_rooms', '>=' ,$n_rooms);
        $queryApartment->where('n_beds', '>=' ,$n_beds);

        $queryApartment->join('images','images.apartment_id','=','apartments.id')
                        ->where('images.cover','=',1)
                        ->get();                      
                        
                      
                        

        if (array_key_exists('services',$request->all())) {

            $servicesCollection = '';

            for ($i = 0; $i < count($services); $i++) {
                
                if ($i == 0) {
                    $servicesCollection = $servicesCollection."apartment_service.service_id = $services[$i]";
                } else {
                    $servicesCollection = $servicesCollection." OR apartment_service.service_id = $services[$i]";
                }

            }

            $queryApartment->whereRaw("(SELECT COUNT(*)
                  FROM apartment_service 
                  WHERE apartment_service.apartment_id = apartments.id 
                  AND ($servicesCollection)) =".count($services)
                ); 

        };    

        $queryApartment->select(
        DB::raw("
        distinct apartments.*,images.imgurl,(
            SELECT GROUP_CONCAT(services.name SEPARATOR ' ')
            FROM apartment_service
            INNER JOIN services ON services.id = apartment_service.service_id
            INNER JOIN apartments AS apconcat ON apconcat.id = apartment_service.apartment_id
            WHERE apartment_service.apartment_id = apartments.id
            ) AS servizi,(
        6371 * acos (
        cos ( radians($lat) )
        * cos( radians( latitude ) )
        * cos( radians( longitude ) - radians($lng) )
        + sin ( radians($lat) )
        * sin( radians( latitude ) )
        )
        ) AS distance
        ")
        )
        ->having('distance', '<=', $range)
        ->orderby('distance')
        ->get();

        $Apartments = $queryApartment->paginate(15);

        return response()->json([
            'apartments' => $Apartments,
            'lat' => $lat,
            'lng' => $lng,
            'range' => $range
        ]);

    }

}
