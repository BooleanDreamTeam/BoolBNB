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
           
            //array con tutti gli id di appartment 
            $apartmentIds = $apartments->pluck('id');

            // active sponsor
            $sponsored = DB::table('sponsorships')
                ->join('apartment_sponsorship', 'sponsorships.id', '=', 'apartment_sponsorship.sponsorship_id')
                ->join('apartments', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
                ->where('apartments.host_id', Auth::id())
                ->where('apartment_sponsorship.expiration_date', '>', now())
                ->get();
                
            
            $sponsoredoff = DB::table('sponsorships')
                ->join('apartment_sponsorship', 'sponsorships.id', '=', 'apartment_sponsorship.sponsorship_id')
                ->join('apartments', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
                ->where('apartments.host_id', Auth::id())
                ->where('apartment_sponsorship.expiration_date', '<', now())
                ->get();
                

            $cover = Image::wherein('apartment_id', $apartmentIds)->where('cover', true)->get();
            
            //filtro i messaggi arrivati per gli appartamenti di proprietà dell'host

            $messages = DB::table('messages')
                ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
                ->join('images', 'images.apartment_id', '=', 'apartments.id')
                ->select('messages.*', 'images.imgurl')
                ->where('images.cover', true)->where('apartments.host_id', Auth::id())
                ->orderBy('created_at', 'desc')->get();

            //
            $reviews = DB::table('reviews')
            ->join('apartments', 'apartments.id', '=', 'reviews.id_apartment')
            ->join('images', 'images.apartment_id', '=', 'apartments.id')
            ->select('reviews.*', 'images.imgurl')
            ->where('apartments.host_id', Auth::id())
            ->where('images.cover', true)
            ->orderBy('created_at', 'desc')->get();

           
        }           
        return view('host.dashboard', compact('apartments', 'apartmentIds', 'messages', 'reviews', 'sponsored', 'cover'));
    }
    
}
