<?php

namespace App;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_apartment', 'browser', 'geo_area', 'visitor', 'created_at'
    ];

    public function apartment(){
        return $this->hasOne('App\Apartment');
    }

    public static function apview($ap){
        $n = DB::table('clicks')->where('id_apartment', $ap)->get(); 
        return count($n);   
    }
}
