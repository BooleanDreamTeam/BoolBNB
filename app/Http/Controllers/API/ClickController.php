<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Click;
use App\Apartment;

class ClickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Click::get(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_apartment' => 'required|numeric|exists:apartments,id',
            'browser' => 'required',
            'geo_area' => 'required',
            'visitor' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['Messaggio' => 'errore inserimento!']);
        }

        $click = Click::create($request->all());

        return response()->json($click,201);
    }
}
