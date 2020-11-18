<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'message', 'apartment_id', 'email',
        'created_at'
    ];

    public static function getmes(){
        
        $messages = DB::table('messages')
        ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
        ->join('images', 'images.apartment_id', '=', 'apartments.id')
        ->select('messages.*', 'images.imgurl')
        ->where('images.cover', true)->where('apartments.host_id', Auth::id())
        ->orderBy('created_at', 'desc')->get();
        return $messages;

    }

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }
}
