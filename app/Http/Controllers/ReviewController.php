<?php

namespace App\Http\Controllers;
use App\Review;
use App\Message;
use App\apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    public function index(){
        if (Auth::user()){
            $reviews = Review::reviews();
            $messages = Message::getmes()->take(4);
            return view('host.reviews', compact('reviews', 'messages'));
        }
    }

    

}
