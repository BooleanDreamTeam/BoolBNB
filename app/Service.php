<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function apartments()
    {
        return $this->belongsToMany('App\Apartment');
    }
}
