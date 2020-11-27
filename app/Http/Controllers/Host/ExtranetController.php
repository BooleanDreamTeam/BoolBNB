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
use Carbon\Carbon;
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
            $apartments = Apartment::where('host_id', Auth::id())->orderby('created_at', 'desc')->take(4)->get();
            $apids= Apartment::where('host_id', Auth::id())->pluck('id');
        
            // $apartments = Apartment::details()->take(4);

            //filtro i messaggi arrivati per gli appartamenti di proprietà dell'host
            $messages = Message::getmes()->take(4);

            //filtro le ultime reviews
            $reviews = Review::reviews()->take(5);

            //filtro i dati per le statistiche 
            $clicks = Click::statistics();
            $brows = Click::brows();
            $views = Click::views()->take(12);
                 
        }           
        return view('host.dashboard', compact('apartments', 'messages', 'reviews', 'clicks', 'brows', 'views'));
    }
    
}
