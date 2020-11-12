<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{
   
    public function index()
    {
        $apartaments = Apartment::all();
        return view('index',compact('apartaments'));
    }

    public function show($id){
        $apartment = Apartment::find($id);
        return view('show-apartment', compact('apartment'));
    }

}
