<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\UserType;
use App\Service;
use App\Message;
use App\User;
use App\Image;
use App\Sponsorship;
use App\Review;
use File; 
use Illuminate\Support\Facades\Auth;
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
