<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Sponsorship;
use App\Apartment;

use Illuminate\Support\Facades\DB;

class SponsorshipController extends Controller
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
        return view('host.sponsorships.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $gateway = new \Braintree\Gateway([
            'environment' => getenv('BT_ENVIRONMENT'),
            'merchantId' => getenv('BT_MERCHANT_ID'),
            'publicKey' => getenv('BT_PUBLIC_KEY'),
            'privateKey' => getenv('BT_PRIVATE_KEY'),
        ]);

        $token = $gateway->clientToken()->generate();

        if (Auth::user()->user_type->name == 'Host'){
            $apartments = Apartment::where('host_id', Auth::id())->orderBy('created_at', 'desc')->get();
        }

        $messages = DB::table('messages')
        ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
        ->join('images', 'images.apartment_id', '=', 'apartments.id')
        ->select('messages.*', 'images.imgurl')
        ->where('images.cover', true)->where('apartments.host_id', Auth::id())
        ->orderBy('created_at', 'desc')->get();


        $sponsorships = Sponsorship::all();

        return view('host.sponsorships.create', compact('apartments','sponsorships','token', 'messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

            $request->validate([
                'amount' => 'numeric|required|min:1|',
                'payment_method_nonce' => 'required',
                'apartment' => 'required|exists:apartments,id',
                'sponsorshipClicked' => 'required',
            ]);

            $gateway = new \Braintree\Gateway([
                'environment' => getenv('BT_ENVIRONMENT'),
                'merchantId' => getenv('BT_MERCHANT_ID'),
                'publicKey' => getenv('BT_PUBLIC_KEY'),
                'privateKey' => getenv('BT_PRIVATE_KEY'),
            ]);

            $amount = $request->amount;

            $nonce = $request->payment_method_nonce;

            $result = $gateway->transaction()->sale([

                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ],
                'customer' => [
                    'firstName' => Auth::user()->name,
                ]

            ]);

            $apartment = Apartment::all()->find($request->apartment);

            $now = Carbon::now();

            $sponsorship = Sponsorship::all()->find($request->sponsorshipClicked);

            $saved = $apartment->sponsorships()->attach($request->sponsorshipClicked , ['started_at' => $now, 'expiration_date' => $now->add($sponsorship->time,'hour')]);


            if ($result) {
                return back()->with('status', 'Sposorizzazione avvenuta con successo!');
            } else {
                return back()->with('error', 'Sposorizzazione negata!');
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Apartment $apartment)
    // {
    //     $services = Service::all();
    //     $apartmentImages = Image::all()->where('apartment_id',$apartment->id);
    //     return view('host.apartments.edit', compact('apartment', 'services', 'apartmentImages'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Apartment $apartment)
    // {
    //     $data = $request->all();

    //     $latlng = $data['latlng'];

    //     $arrayCordinates = explode(",", $latlng);

    //     $lat = $arrayCordinates[0];
    //     $lng = $arrayCordinates[1];

    //     $data['latitude'] = $lat;
    //     $data['longitude'] = $lng;
    //     $data['host_id'] = Auth::id();

    //     $request->validate([
    //         'title' => 'required|min:5|max:255',
    //         'n_rooms' => 'required|min:1|max:4',
    //         'n_beds' => 'required|min:1|max:4',
    //         'n_bathrooms' => 'required|min:1|max:4',
    //         'squaremeters' => 'required|min:1|max:6',
    //         'description' => 'required|min:5|max:300',
    //         'host_id' => 'numeric|exists:users,id'
    //     ]);

    //     if (!empty($data['services'])){
    //         $apartment->services()->sync($data['services']);
    //     }  else {
    //         $apartment->services()->detach();
    //     }

    //     $apartment->update($data);

    //     return redirect()->route('dashboard')->with('session', "Modifiche all'appartamento $apartment->title  effettuate");
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        dd($request);

        return back()->with('session', 'Hai cancellato correttamente la tua sponsorship!');
    }
}
