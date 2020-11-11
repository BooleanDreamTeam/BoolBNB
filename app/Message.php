<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'message', 'apartment_id', 'email',
        'created_at'
    ];

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }
}
