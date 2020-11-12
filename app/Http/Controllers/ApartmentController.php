<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Image;

class ApartmentController extends Controller
{
   
    public function index()
    {
        $apartaments = Apartment::all();
        return view('index',compact('apartaments'));
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
        dd($images, $cover);
        return view('show-apartment', compact('apartment'));
    }

}
