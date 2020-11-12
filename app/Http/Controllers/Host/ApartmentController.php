<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use App\Apartment;
use App\UserType;
use App\Service;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Auth::user()->user_type->name == 'Host'){
            $apartments = Apartment::where('host_id', Auth::id())->orderBy('created_at', 'desc');
        } 
        return view('host.apartment.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view('host.apartment.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'title' => 'required|min:5|max:255',
            'n_rooms' => 'required|min:1|max:4',
            'n_beds' => 'required|min:1|max:4',
            'n_bathrooms' => 'required|min:1|max:4',
            'squaremeters' => 'required|min:1|max:6',
            'latitude' => 'required',
            'longitude' => 'required',
            'is_active' => 'required',
        ]);
        $data['host_id'] = Auth::id();
        $data['updated_at'] = Carbon::now('Europe/Rome');

        $apartmentNew = new Apartment();

        $apartmentNew->fill($data); 

        $saved = $apartmentNew->save();

        if(!empty($data['services'])){
            $postNew->services()->attach($data['services']);
        }

        if($saved){
            return redirect()->route('host.apartments.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::all();
        return view('host.apartments.edit', compact('post', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $data = $request->all();

        $request->validate([
            'title' => 'required|min:5|max:255',
            'n_rooms' => 'required|min:1|max:4',
            'n_beds' => 'required|min:1|max:4',
            'n_bathrooms' => 'required|min:1|max:4',
            'squaremeters' => 'required|min:1|max:6',
            'latitude' => 'required',
            'longitude' => 'required',
            'is_active' => 'required',
        ]);

        if (!empty($data['services'])){
            $apartment->services()->sync($data['services']);
        }  else {
            $apartment->services()->detach();
        }
        
        $apartment->update($data); 

        return redirect()->route('host.apartments.index')->with('status', 'Modifiche effettuate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment->delete();
        return redirect()->route('host.aparment.index')->with('status', 'Hai cancellato correttamente il tuo appartamento');
    }
}
