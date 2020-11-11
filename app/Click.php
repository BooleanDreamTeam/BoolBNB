<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_appartament', 'browser', 'geo_location', 'ip_address', 'created_at'
    ];

    public function apartment(){
        return $this->hasOne('App\Apartment');
    }
}
