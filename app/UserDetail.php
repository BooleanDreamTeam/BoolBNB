<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'birth_date', 'address', 'phone_n', 'avatar'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
