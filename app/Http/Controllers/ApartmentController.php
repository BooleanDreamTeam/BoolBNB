<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Image;
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
        $apartments = Apartment::whereNotIn('id', $toremove)->take(7)->get();

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

}
