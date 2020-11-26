<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Message;

use Illuminate\Http\Request;

class MessageController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'message' => 'required|min:5|max:255',
            'email' => 'required'
        ]);

        $messageNew = new Message;

        $messageNew->fill($request->all());

        $saved = $messageNew->save();

        if ($saved) {
            return back()->with('status','Messaggio inviato con successo!');
        } else {
            return back()->with('error_message','Messaggio non inviato causa errore!');
        }
    }

    public function index(){
        if (Auth::user()){
            $messages = Message::getmes()->take(4);
            $allmessages = Message::getmes();
            return view('host.messages', compact('messages', 'allmessages'));

        }
    }
}
