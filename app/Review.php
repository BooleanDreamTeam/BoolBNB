<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_appartament', 'name', 'message', 'vote', 'created_at'
    ];

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }

}
