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

    
}
