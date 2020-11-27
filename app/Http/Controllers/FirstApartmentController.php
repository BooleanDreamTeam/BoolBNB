<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Apartment;
use App\Service;
use App\Image;
use App\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FirstApartmentController extends Controller
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
    public function create(User $user)
    {
        $services = Service::all();
    
        return view('host.firstapartment', compact('services'));
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

        $latlng = $data['latlng'];

        $arrayCordinates = explode(",", $latlng);

        $lat = $arrayCordinates[0];
        $lng = $arrayCordinates[1];

        $data['latitude'] = $lat;
        $data['longitude'] = $lng;
        $data['host_id'] = Auth::id();

        $request->validate([
            'title' => 'required|min:5|max:255',
            'n_rooms' => 'required|min:1|max:4',
            'n_beds' => 'required|min:1|max:4',
            'n_bathrooms' => 'required|min:1|max:4',
            'squaremeters' => 'required|min:1|max:6',
            'description' => 'required|min:5|max:3000',
            'host_id' => 'numeric|exists:users,id'
        ]);

        $apartment = Apartment::create([
            'address' => $data['address'],
            'host_id' => $data['host_id'],
            'title' => $data['title'],
            'n_rooms' => $data['n_rooms'],
            'n_beds' => $data['n_beds'],
            'n_bathrooms' => $data['n_bathrooms'],
            'squaremeters' => $data['squaremeters'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'description' => $data['description']
        ]);

        if ((array_key_exists('services', $data))) {
            $apartment->services()->attach($data['services']);
        }

        if ((array_key_exists('images', $data))) {
            foreach ($data['images'] as $key => $image) {
                $data['images'][$key] = Storage::disk('public')->put("img/users/". Auth::id() ."/apartments/$apartment->id",$image);

                $urlImg = Storage::url($data['images'][$key]);

                if ($key == 0) {
                    $imageToDb = Image::create([
                        'apartment_id' => $apartment->id,
                        'imgurl' => $urlImg,
                        'cover' => 1,
                    ]);    
                } else {

                    $imageToDb = Image::create([
                        'apartment_id' => $apartment->id,
                        'imgurl' => $urlImg,
                        'cover' => 0,
                    ]);

                }

            }
                
        }  
        DB::update('update users set user_type_id = 2 where id = ?', [Auth::id()]);
        
        return redirect()->route('apartment.show', $apartment->id);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

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

    public function behost()
    {
        User::where('id', Auth::id())->update('user_tipe_id', 2);
        return view('/');
    }

}
