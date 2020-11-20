<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Treffynnon\Navigator as N;
use App\Apartment;
use App\Image;
use App\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class ApartmentController extends Controller
{

    public function index()
    {
        // prendo 4 appartamenti con almeno una sponsorship attiva
        $sponsored = Apartment::whereHas('sponsorships', function (Builder $query) {
            $query->where('expiration_date', '>', DB::raw('now()'));
        })->take(4)->get();

        // salvo in una variabile tutti gli id degli appartamenti che hanno almeno una sponsorship attiva
        $toremove = Apartment::whereHas('sponsorships', function (Builder $query) {
        $query->where('expiration_date', '>', DB::raw('now()'));
        })->pluck('id');

        // estraggo 4 appartamenti sottraendo gli id degli appartamenti con spons. attiva
        $apartments = Apartment::whereNotIn('id', $toremove)->take(8)->get();

        return view('index',compact('sponsored', 'apartments'));
    }

    public function show($id){
        $apartment = Apartment::find($id);
        $images = Image::where([
            ['apartment_id','=', $id],
            ['cover', '=', 0]
        ])->get();
        $cover = Image::where([
            ['apartment_id','=', $id],
            ['cover', '=', 1]
        ])->get();
        return view('show-apartment', compact('apartment', 'images', 'cover'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function searching(Request $request) {

        $services = Service::all();

        $latlng = $request['cordinates'];

        $arrayCordinates = explode(",", $latlng);

        $lat = $arrayCordinates[0];
        $lng = $arrayCordinates[1];


        if($request['radius']){
            $radius = $request['radius'] * 1000;
        } else {
            $radius = 10000;
        }

        $apartments = Apartment::select(
            // https://gis.stackexchange.com/a/31629  // il codice 6371 serve per il calcolo in km
            DB::raw("
            *, (
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
            ->having('distance', '<=', $radius)
            ->get();

            return view('search', compact('apartments','services','lat','lng'));

        }

}
