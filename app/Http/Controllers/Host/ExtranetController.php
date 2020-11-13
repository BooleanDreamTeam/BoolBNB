<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\UserType;
use App\Service;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ExtranetController extends Controller
{
    public function extranet()
    {
        //tutti gli appartamenti di proprietà dell'host
        if (Auth::user()->user_type->name == 'Host'){
            $apartments = Apartment::where('host_id', Auth::id())->orderBy('created_at', 'desc');
        } 
        
        //tutti i servizi
        $services = Service::all();

        //creo un array con gli id degli appartmenti di proprietà dell'host
        $arrayId = DB::table($apartments)->pluck('id');

        //filtro i messaggi arrivati per gli appartamenti di proprietà dell'host
        $messages = DB::table('messages')
        ->whereIn('apartment_id', $arrayId);

        $review = DB::table('reviews')
        ->whereIn('apartment_id', $arrayId);

        $sponsored = DB::table('sponsorships')
            ->join('apartment_sponsorship', 'sponsorships.id', '=', 'apartment_sponsorship.sponsorship_id')
            ->join('apartments', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
            ->select('sponsorships.*', 'apartments.*')
            ->where('apartments.host_id', Auth::id())
            ->where('apartment_sponsorship.expiration_date', '>', now())
            ->get();

        return view('host.extranet', compact('apartments', 'services', 'messages' ));
    }
    
}
