<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\Items;
use Carbon\Carbon;
use Session;

class Usercontroller extends Controller
{
    
    /**
     * Create a new controller & cart instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('ontlenen/register');
    }

    /**
     * Validate form input and set date
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function set(Request $request)
    {
        $validate = $request->validate([
            'email' => 'bail|required|',
            'studentenNummer' => 'bail|required|',
        ],[
            'email.required' => 'Whoops, gelieve een email-adres in te geven.',
            'studentenNummer.required' => 'Whoops, gelieve een studentennummer in te geven.',
        ]);

        $user = [
            'email' => $validate['email'],
            'card' => $validate['studentenNummer'],
        ];

        $request->session()->put('user', $user);
        return redirect('/overzicht');
    }
}
