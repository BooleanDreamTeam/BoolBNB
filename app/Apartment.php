<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'title', 'n_rooms', 'n_beds', 'n_bathrooms',
        'squaremeters', 'latitude', 'longitude', 'is_active',
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
        return $this->hasMany('App\Sponsorship');
    }

    public function clicks(){
        return $this->belongsTo('App\Click');
    }

    public function image(){
        return $this->hasMany('App\Image');
    }

    
}