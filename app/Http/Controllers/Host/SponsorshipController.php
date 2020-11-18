<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Sponsorship;
use App\Apartment;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     if (Auth::user()->user_type->name == 'Host'){
    //         $apartments = Apartment::where('host_id', Auth::id())->orderBy('created_at', 'desc')->get();
    //     }
    //     return view('host.apartments.index', compact('apartments'));
    // }

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

        $sponsorships = Sponsorship::all();

        return view('host.sponsorships.create', compact('apartments','sponsorships','token'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
                ]

            ]);

            DB::create('update apartment_sponsorship set user_type_id = 2 where id = ?', [Auth::id()]);

            $apartment = Apartment::all()->find($request->apartment);

            $saved = $apartment->sponsorships()->attach($request->sponsorshipClicked);

            if ($saved) {
                return back()->with('success_message', 'Sposorizzazione avvenuta con successo!');
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
    // public function destroy(Apartment $apartment)
    // {
    //     $apartment->delete();
    //     return redirect()->route('dashboard')->with('session', 'Hai cancellato correttamente il tuo appartamento');
    // }
}
