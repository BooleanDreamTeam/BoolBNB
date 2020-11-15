<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\UserDetail;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {

        $user = Socialite::driver('facebook')->user();


        // IP UTENTE
        $ip = $_SERVER['REMOTE_ADDR'];

        $userCreate = User::firstOrCreate([

            'name'=>$user->getName(),
            'email'=>$user->getEmail(),
            'provider_id'=>$user->getId()

        ]);

        
        $fileContents = file_get_contents($user->getAvatar());

        Storage::disk('public')->put('img/users/' . $userCreate->id . "/avatar.jpg", $fileContents);

        $url = Storage::url('img/users/' . $userCreate->id . "/avatar.jpg");   

        $userDetail = UserDetail::firstOrCreate([

            'user_id'=>$userCreate->id,
            'birth_date'=>NULL,
            'address'=>NULL,
            'phone_n'=>NULL,
            'avatar'=> $url

        ]);

        Auth::Login($userCreate,true);

        return redirect('/');
    }

}
