<?php

namespace App;
use App\Apartment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Click extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_apartment', 'browser', 'geo_area', 'visitor', 'created_at'
    ];

    public function apartment(){
        return $this->hasOne('App\Apartment');
    }

    public static function statistics(){
        return DB::table('clicks')
        ->select(DB::raw("count(*) as clicks, clicks.geo_area"))
        ->join('apartments', 'apartments.id', '=', 'clicks.id_apartment')
        ->join('users', 'users.id', '=', 'apartments.host_id')
        ->where('users.id', '=', Auth::id())
        ->groupBy('clicks.geo_area')
        ->orderby('clicks', 'desc')
        ->get();  
    }

    public static function brows(){
        return DB::table('clicks')
        ->select(DB::raw("count(*) as clicks, clicks.browser"))
        ->join('apartments', 'apartments.id', '=', 'clicks.id_apartment')
        ->join('users', 'users.id', '=', 'apartments.host_id')
        ->where('users.id', '=', Auth::id())
        ->groupBy('clicks.browser')
        ->take(6)
        ->get();  
    }

    public static function views(){
         return DB::table('clicks')
        ->join('apartments', 'clicks.id_apartment', '=', 'apartments.id')
        ->selectRaw('MONTH(clicks.created_at) as mon, YEAR (clicks.created_at) AS yr , count(id_apartment) as views')
        ->where('apartments.host_id', Auth::id())
        ->groupby('mon', 'yr')
        ->havingRaw('yr = 2020')
        ->orderby('mon')
        ->get();
    }
}

// select extract(year from created_at) as yr, extract(month from created_at) as mon,
//        COUNT(id)
// from clicks
// group by extract(year from created_at), extract(month from created_at)
// order by yr, mon;

// SELECT MONTH(created_at) as mon, YEAR (created_at) AS yr , count(id_apartment) as views, id_apartment
// FROM clicks
// WHERE id_apartment = 61
// GROUP BY mon, yr, id_apartment
// ORDER BY yr, mon
