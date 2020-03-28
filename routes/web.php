<?php

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
    return view('home');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('ontlenen', 'CardController@index');

Route::post('ontlenen/add', 'CardController@store');
Route::get('ontlenen/{id}', 'CardController@destroy');
Route::post('ontlenen/back', 'CardController@flush');

Route::get('datum', 'RentalController@index');
Route::post('datum/set', 'RentalController@set');

Route::get('user', 'Usercontroller@index');
Route::post('user/set', 'Usercontroller@set');

Route::get('overzicht', 'FinalRentalController@index');
Route::get('overzicht/set', 'FinalRentalController@set');