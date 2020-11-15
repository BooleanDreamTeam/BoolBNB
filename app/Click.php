<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_apartment', 'browser', 'geo_area', 'visitor'
    ];

    public function apartment(){
        return $this->hasOne('App\Apartment');
    }
}
