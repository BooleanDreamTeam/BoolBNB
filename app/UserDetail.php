<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';

    protected $timestamps = false;

    protected $fillable = [
        'birth_date', 'address', 'phone_n', 'avatar'
    ];

    public function user(){
        return $this->hasOne('App\User');
    }
}
