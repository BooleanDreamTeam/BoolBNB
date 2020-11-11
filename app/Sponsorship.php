<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $timestamps = false;

    protected $fillable = [
        'name', 'price', 'time'
    ];

    public function apartments(){
        return $this->hasMany('App\Apartment');
    }
}
