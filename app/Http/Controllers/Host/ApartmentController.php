<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Apartment;
use App\Service;
use App\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;


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
            $apartments = Apartment::where('host_id', Auth::id())->orderBy('created_at', 'desc')->get();
        }
        return view('host.apartments.index', compact('apartments'));
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
            'description' => 'required|min:5|max:300',
            'host_id' => 'numeric|exists:users,id'
        ]);

        $apartment = Apartment::create([
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

                $imageToDb = Image::create([
                    'apartment_id' => $apartment->id,
                    'imgurl' => $urlImg,
                    'cover' => 1,
                ]);

            }
                
        }
            
        return redirect('host/extranet');

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
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect()->route('host.aparment.index')->with('status', 'Hai cancellato correttamente il tuo appartamento');
    }
}
