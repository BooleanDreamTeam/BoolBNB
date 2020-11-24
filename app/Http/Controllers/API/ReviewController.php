<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Review;

class ReviewController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reviews(Request $request)
    {

        return response()->json(['reviews' => DB::table('reviews')->where('id_apartment','=',$request['id'])->orderByRaw('created_at DESC')->get() ]);

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request['user']){

            $review = Review::create([
                'id_apartment' => $request['id_apartment'],
                'name' => $request['user'],
                'message' => $request['message'],
                'vote' => $request['vote'],
                'created_at' => Carbon::now('Europe/London')
            ]);
            
        } else {

            $review = Review::create([
                'id_apartment' => $request['id_apartment'],
                'name' => Auth::user()->name,
                'message' => $request['message'],
                'vote' => $request['vote'],
                'created_at' => Carbon::now('Europe/London')
            ]);

        }

        return response()->json($review,201);

    }

}
