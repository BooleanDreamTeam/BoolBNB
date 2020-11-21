<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title', 'description', 'n_rooms', 'n_beds', 'n_bathrooms',
        'squaremeters', 'address', 'latitude', 'longitude', 'is_active',
        'created_at', 'updated_at', 'host_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function sponsorships(){
        return $this->belongsToMany('App\Sponsorship')->withPivot('expiration_date','started_at');
    }

    public function clicks(){
        return $this->belongsTo('App\Click');
    }

    public function image(){
        return $this->hasMany('App\Image');
    }

    public function cover(){
        return $this->hasOne('App\Image')->where('cover', 1);
    }

    public static function details(){
        return DB::table('reviews')
        ->join('apartments', 'apartments.id', '=', 'id_apartment')
        ->join('images', 'images.apartment_id', '=', 'reviews.id_apartment')
        ->select('images.imgurl', DB::raw('AVG(vote) as vote'), 'apartments.*')
        ->where('apartments.host_id', Auth::id())
        ->where('images.cover', true)
        ->groupBy('id_apartment', 'images.imgurl')
        ->orderby('created_at', 'desc')
        ->get();
    }

}

