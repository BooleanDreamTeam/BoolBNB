<?php

namespace App;
use Illuminate\Support\Facades\DB;


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
        ->get();  
    }


}
