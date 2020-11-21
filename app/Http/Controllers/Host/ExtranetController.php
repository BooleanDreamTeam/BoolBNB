<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Sponsorship;
use App\Image;
use App\Message;
use App\Review;
use App\Click;

use App\User;
use Illuminate\Support\Facades\DB;

use File; 

class ExtranetController extends Controller
{
    public function dashboard()
    {
        //tutti gli appartamenti di proprietà dell'host
        if (Auth::user()->user_type->name == 'Host'){

            // vediamo i nostri appartamenti
            $apartments = Apartment::details()->take(4);
           
            //array con tutti gli id di appartment 
            $apartmentIds = $apartments->pluck('id');

            // active sponsor

            $sponsored = Sponsorship::sponsored();
            $sponsoredoff = Sponsorship::nosponsored();

            
 
            //filtro i messaggi arrivati per gli appartamenti di proprietà dell'host
            $messages = Message::getmes()->take(4);

            //
            $reviews = Review::reviews()->take(5);

            

   
            
            $clicks = DB::table('clicks')
                        ->select(DB::raw("count(*) as clicks, clicks.geo_area"))
                        ->join('apartments', 'apartments.id', '=', 'clicks.id_apartment')
                        ->join('users', 'users.id', '=', 'apartments.host_id')
                        ->where('users.id', '=', Auth::id())
                        ->groupBy('clicks.geo_area')
                        ->get();


        }           
<<<<<<< Updated upstream
        return view('host.dashboard', compact('apartments', 'apartmentIds', 'messages', 'reviews', 'sponsored' ));
=======
        return view('host.dashboard', compact('apartments', 'apartmentIds', 'messages', 'reviews', 'sponsored', 'cover', 'clicks'));
>>>>>>> Stashed changes
    }
    
}
