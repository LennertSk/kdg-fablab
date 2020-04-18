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

Route::get('/indienen', 'ReturnController@index');
Route::post('/indienen/set', 'ReturnController@set');
Route::post('/indienen/final', 'ReturnController@final');

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

Route::get('/dashboard', 'AdminController@dashboard')    
    ->middleware('is_admin')    
    ->name('admin');

Route::get('/dashboard/users', 'AdminController@users')    
    ->middleware('is_admin')    
    ->name('admin');

Route::get('/dashboard/user/{id}', 'AdminController@user')    
    ->middleware('is_admin')    
    ->name('admin');

Route::post('/dashboard/user/set', 'AdminController@set')    
    ->middleware('is_admin')    
    ->name('admin');

Route::get('/dashboard/delete/{id}', 'AdminController@delete')    
    ->middleware('is_admin')    
    ->name('admin');

Route::get('/dashboard/item/{id}', 'AdminController@info')    
    ->middleware('is_admin')    
    ->name('admin');

Route::post('/dashboard/item/set', 'AdminController@itemSet')    
    ->middleware('is_admin')    
    ->name('admin');

Route::get('/dashboard/gebruiker/{id}', 'AdminController@gebruiker')    
    ->middleware('is_admin')    
    ->name('admin');
Route::get('/dashboard/ontleningen', 'AdminController@rentals')    
    ->middleware('is_admin')    
    ->name('admin');
Route::get('/dashboard/addItem', 'AdminController@addItem')    
    ->middleware('is_admin')    
    ->name('admin');
Route::post('/dashboard/addItem/add', 'AdminController@addItemAdd')    
    ->middleware('is_admin')    
    ->name('admin');