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
use Illuminate\Support\Facades\DB;


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
        $apartmentIds = $apartments->pluck('id');
        $cover = Image::wherein('apartment_id', $apartmentIds)->where('cover', true)->get();
        
        $messages = DB::table('messages')
        ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
        ->join('images', 'images.apartment_id', '=', 'apartments.id')
        ->select('messages.*', 'images.imgurl')
        ->where('images.cover', true)->where('apartments.host_id', Auth::id())
        ->orderBy('created_at', 'desc')->get();
        return view('host.apartments.index', compact('apartments', 'messages', 'cover'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $messages = DB::table('messages')
        ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
        ->join('images', 'images.apartment_id', '=', 'apartments.id')
        ->select('messages.*', 'images.imgurl')
        ->where('images.cover', true)->where('apartments.host_id', Auth::id())
        ->orderBy('created_at', 'desc')->get();

        return view('host.apartments.create', compact('services', 'messages'));
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
            
        return redirect()->route('dashboard')->with('session', "Appartamento $apartment->title creato!");

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
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        $apartmentImages = Image::all()->where('apartment_id',$apartment->id);
        return view('host.apartments.edit', compact('apartment', 'services', 'apartmentImages'));
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

        if (!empty($data['services'])){
            $apartment->services()->sync($data['services']);
        }  else {
            $apartment->services()->detach();
        }

        $apartment->update($data);

        return redirect()->route('dashboard')->with('session', "Modifiche all'appartamento $apartment->title  effettuate");
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
        return redirect()->route('dashboard')->with('session', 'Hai cancellato correttamente il tuo appartamento');
    }
}
