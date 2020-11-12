<?php

use Illuminate\Support\Facades\Route;
use App\Apartment;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $apartments = Apartment::take(3)->get(); //get first 3 apartments
    return view('index', compact('apartments'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ROUTE SOCIALIZE

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
