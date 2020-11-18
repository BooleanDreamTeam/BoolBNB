<?php

namespace App\Http\Controllers;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(){
        if (Auth::user()){
            $reviews = review::reviews();
            return view('host.reviews', compact('reviews'));
        }
    }
}
