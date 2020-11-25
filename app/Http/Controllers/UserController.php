<?php

namespace App\Http\Controllers;
use App\User;
use App\Message;
use App\UserDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()){
            
            $user = Auth::user();
            
            $messages = Message::getmes()->take(4);
           
            return view('user.show', compact('user', 'messages'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()){
            $user = Auth::user();
            $messages = Message::getmes()->take(4);  
            $user_details = UserDetail::where('user_id', Auth::id())->get();
              
            return view('user.edit', compact('user', 'messages', 'user_details'));
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {   

        
        if(Auth::user()){

            $details = $user->user_details;

            $request->validate([ 
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user)
                ],
                'avatar' => 'nullable|image',
                'address' => 'nullable|string|max:255',
                'phone_n' => 'nullable|string|max:255',
            ]);
            
            $dataUser = [
                'name' => $request['name'], 
                'email' => $request['email'], 
            ];

            if(!empty($request['password'])){
                $dataUser['password']= Hash::make($request['password']);
            }

            $dataDet = [
                'address' => $request['address'], 
                'phone_n' => $request['phone_n'],
                'birth_date' => $request['birth_date']
            ];
            
            if(empty($user->provider_id)){
                if(!empty($request['avatar'])){
                    if(!empty($details['avatar'])){
                        Storage::disk('public')->delete($details['avatar']);
                    }
                    $image = Storage::disk('public')->put("img/users/".Auth::id(), $request['avatar']);
                    $url = Storage::url($image); 
                }
    
                $dataDet['avatar'] = $url;
            }

                  
            $user->update($dataUser);
            // $details->delete();
            $details->update($dataDet);


            return redirect()->route('dashboard')->with('status', "Modifiche al tuo profilo effettuate");

        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
