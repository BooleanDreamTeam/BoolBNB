<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'apartment_id', 'imgurl', 'cover', 'created_at'
    ];

    public function apartment(){
        return $this->belongsTo('App\User');
    }

}
