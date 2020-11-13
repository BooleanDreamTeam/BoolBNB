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
        $apartments = Apartment::whereHas('sponsorships', function (Builder $query) {
            $query->where('expiration_date', '>', DB::raw('now()'));
        })->get();
        return view('index',compact('apartments'));
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
        return view('show-apartment', compact('apartment'));
    }

}
