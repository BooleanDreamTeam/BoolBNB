<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Sponsorship;
use App\Image;
use App\Message;
use App\Review;
use App\Click;

use App\User;

use File; 

class ExtranetController extends Controller
{
    public function dashboard()
    {
        //tutti gli appartamenti di proprietà dell'host
        if (Auth::user()->user_type->name == 'Host'){

            // vediamo i nostri appartamenti
            $apartments = Apartment::where('host_id', Auth::id())->orderBy('created_at', 'desc')->take(4)->get();
           
            //array con tutti gli id di appartment 
            $apartmentIds = $apartments->pluck('id');

            // active sponsor

            $sponsored = Sponsorship::sponsored();
            $sponsoredoff = Sponsorship::nosponsored();

            $cover = Image::wherein('apartment_id', $apartmentIds)->where('cover', true)->get();
 
            //filtro i messaggi arrivati per gli appartamenti di proprietà dell'host
            $messages = Message::getmes()->take(4);

            //
            $reviews = Review::reviews()->take(5);
            
            
        }           
        return view('host.dashboard', compact('apartments', 'apartmentIds', 'messages', 'reviews', 'sponsored', 'cover'));
    }
    
}
