<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'price', 'time'
    ];

    public function apartments(){
        return $this->belongsToMany('App\Apartment');
    }
}
