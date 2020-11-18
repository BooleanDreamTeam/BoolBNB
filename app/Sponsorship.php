<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'price', 'time'
    ];

    public function apartments(){
        return $this->belongsToMany('App\Apartment');
    }

    public static function sponsored(){
        $sponsored = DB::table('sponsorships')
        ->join('apartment_sponsorship', 'sponsorships.id', '=', 'apartment_sponsorship.sponsorship_id')
        ->join('apartments', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
        ->where('apartments.host_id', Auth::id())
        ->where('apartment_sponsorship.expiration_date', '>', now())
        ->get();

        return $sponsored;
    }

    public static function nosponsored(){
        $sponsoredoff = DB::table('sponsorships')
                ->join('apartment_sponsorship', 'sponsorships.id', '=', 'apartment_sponsorship.sponsorship_id')
                ->join('apartments', 'apartments.id', '=', 'apartment_sponsorship.apartment_id')
                ->where('apartments.host_id', Auth::id())
                ->where('apartment_sponsorship.expiration_date', '<', now())
                ->get();
        return $sponsoredoff;
    }
}
