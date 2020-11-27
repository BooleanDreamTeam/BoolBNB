<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Apartment;
use App\Image;
use App\Service;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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
            $apartments = Apartment::where('host_id', Auth::id())->get();

            $messages = Message::getmes()->take(4);
            return view('host.apartments.index', compact('apartments', 'messages'));
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $messages = Message::getmes()->take(4);

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

        return redirect()->route('dashboard')->with('status', "Appartamento $apartment->title creato!");

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
        $messages = Message::getmes()->take(4);
        $services = Service::all();
        $apartmentImages = Image::all()->where('apartment_id', $apartment->id);
        return view('host.apartments.edit', compact('apartment', 'services', 'apartmentImages', 'messages'));
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

        if($latlng) {
            $arrayCordinates = explode(",", $latlng);

            $lat = $arrayCordinates[0];
            $lng = $arrayCordinates[1];

            $data['latitude'] = $lat;
            $data['longitude'] = $lng;
        }

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

        if($data['cover_image_id']) {
            Image::where('apartment_id', $apartment->id)->update(['cover' => 0]);
            Image::where('id', $data['cover_image_id'])->update(['cover' => 1]);
        }

        if ((array_key_exists('images', $data))) {
            foreach ($data['images'] as $key => $image) {
                $data['images'][$key] = Storage::disk('public')->put("img/users/". Auth::id() ."/apartments/$apartment->id",$image);

                $urlImg = Storage::url($data['images'][$key]);

                $imageToDb = Image::create([
                    'apartment_id' => $apartment->id,
                    'imgurl' => $urlImg,
                    'cover' => 0,
                ]);

            }

        }

        if (!empty($data['services'])){
            $apartment->services()->sync($data['services']);
        }  else {
            $apartment->services()->detach();
        }

        $apartment->update($data);

        return redirect()->route('dashboard')->with('status', "Modifiche all'appartamento $apartment->title  effettuate con successo");
    }

    public function deleteImage(Image $image) {

        if($image->cover) {
            $image->delete();
            $images = Image::where(['apartment_id' => $image->apartment_id])->get();
            if(isset($images[0])) {
                $images[0]->cover = 1;
                $images[0]->save();
            }
        } else {$image->delete();
            }

        return redirect()->route('apartments.edit', $image->apartment_id)->with('status', 'Immagine cancellata correttamente');
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

        return redirect()->route('dashboard')->with('status', 'Hai cancellato correttamente il tuo appartamento');
    }

    public function active(Request $request, Apartment $apartment)
    {
        $data = $request->all();
        $apartment->update($data);
        if($request->is_active !== false){
            return redirect()->route('apartments.edit', $apartment->id)->with('status', "Ora il tuo appartmento è attivo, controlla le tue modifiche");
        }else{
            return redirect()->route('apartments.edit', $apartment->id)->with('status', "Il tuo appartamento non è più attivo");
        }

    }
}
