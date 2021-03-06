<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'ApartmentController@index');
Route::get('apartments/show/{id}', 'ApartmentController@show')->name('apartment.show');
Route::get('/search', 'ApartmentController@searching')->name('search');
Route::resource('firstapartment', 'FirstApartmentController')->middleware('auth');
Route::post('message', 'MessageController@store')->name('sendMessage');

Auth::routes();

// ROUTE SOCIALIZE

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::resource('user', 'UserController')->middleware('auth');

//Route degli Host registrati
Route::prefix('host')->namespace('Host')->middleware('auth')->group(function() {
    Route::get('extranet', 'ExtranetController@extranet')->name('extranet');
    Route::resource('apartments', 'ApartmentController');
    Route::get('apartments/delete-image/{image}', 'ApartmentController@deleteImage')->name('delete-image');
    Route::patch('apartments/active/{apartment}', 'ApartmentController@active')->name('active');
    Route::get('dashboard', 'ExtranetController@dashboard')->name('dashboard');
    Route::resource('sponsorship', 'SponsorshipController');
    Route::post('checkout', 'SponsorshipController@checkout')->name('checkout');
});
Route::get('host.messages', 'MessageController@index')->middleware('auth')->name('mymessages');
Route::get('host.reviews', 'ReviewController@index')->middleware('auth')->name('myreviews');

Route::group(['prefix' => 'admin', 'middleware' => 'guest'],function (){
    Route::get('/home', 'HomeController@index')->name('home');
});

//Route degli user

