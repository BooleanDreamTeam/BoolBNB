<?php

namespace App;
use App\Apartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_apartment', 'name', 'message', 'vote', 'created_at'
    ];

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }

 
    public static function reviews(){
        return DB::table('reviews')
        ->join('apartments', 'apartments.id', '=', 'reviews.id_apartment')
        ->join('images', 'images.apartment_id', '=', 'apartments.id')
        ->select('reviews.*', 'images.imgurl')
        ->where('apartments.host_id', Auth::id())
        ->where('images.cover', true)
        ->orderBy('created_at', 'desc')->get();
    }




}

