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

Route::get('/', 'ApartmentController@index');
Route::get('apartments/show/{id}', 'ApartmentController@show')->name('apartment.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ROUTE SOCIALIZE

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

//Route degli Host registrati



Route::prefix('host')->namespace('Host')->middleware('auth')->group(function() {
    Route::get('extranet', 'ExtranetController@extranet')->name('extranet');
    Route::resource('apartments', 'ApartmentController');
});

Route::group(['prefix' => 'admin', 'middleware' => 'guest'],function (){
    Route::get('/home', 'HomeController@index')->name('home');
 });