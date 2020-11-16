<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\UserType;
use App\Service;
use App\Message;
use App\User;
use File; 

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ExtranetController extends Controller
{
    public function dashboard()
    {
        //tutti gli appartamenti di proprietà dell'host
        if (Auth::user()->user_type->name == 'Host'){
            // vediamo i nostri appartamenti
            $apartments = Apartment::where('host_id', Auth::id())->orderBy('created_at', 'desc')->get();
           
            //array con tutti gli id 
            $apartmentIds = $apartments->pluck('id');

             //tutti i servizi
            $services = Service::all();
            $myservices = DB::table('services')
                ->join('apartment_service', 'apartment_service.service_id', '=', 'services.id')
                ->select('apartment_service.*')
                ->whereIn('apartment_service.apartment_id', $apartmentIds)
                ->get();

            //filtro i messaggi arrivati per gli appartamenti di proprietà dell'host
            $messages = DB::table('messages')
                ->join('apartments', 'apartments.id', '=', 'messages.apartment_id')
                ->select('messages.*')
                ->where('apartments.host_id', Auth::id())
                ->get();

                //
            $reviews = DB::table('reviews')
                ->join('apartments', 'apartments.id', '=', 'reviews.id_apartment')
                ->select('reviews.*')
                ->where('apartments.host_id', Auth::id())
                ->get();

            // 
            $sponsored = DB::table('sponsorships')
                ->join('apartment_sponsorship', 'sponsorships.id', '=', 'apartment_sponsorship.sponsorship_id')
                ->join('apartments', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
                ->select('sponsorships.*', 'apartments.id','apartment_sponsorship.*')
                ->where('apartments.host_id', Auth::id())
                ->where('apartment_sponsorship.expiration_date', '>', now())
                ->get();

            $sponsoredoff = DB::table('sponsorships')
                ->join('apartment_sponsorship', 'sponsorships.id', '=', 'apartment_sponsorship.sponsorship_id')
                ->join('apartments', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
                ->select('sponsorships.*', 'apartments.id','apartment_sponsorship.*')
                ->where('apartments.host_id', Auth::id())
                ->where('apartment_sponsorship.expiration_date', '<', now())
                ->get();

        }           
        return view('host.dashboard', compact('apartments', 'apartmentIds', 'services', 'messages', 'reviews', 'sponsored'));
    }
    
}
