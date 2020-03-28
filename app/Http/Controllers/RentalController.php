<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\Items;
use Carbon\Carbon;
use Session;

class RentalController extends Controller
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

        // $cart = $request->session()->get('cart', 'no items found');
        $cart = Session::get('cart');
        $date = Session::get('end_date');
        if(empty($cart)) {$disabled = false;} else {$disabled = true;}

        // return view('ontlenen/datum', compact('cart'))->with('disabled', $disabled);
        return view('ontlenen/datum', compact('cart'), ['disabled' => $disabled, 'date' => $date]);
    }

    /**
     * Validate form input and set date
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function set(Request $request)
    {
        $current_date = Carbon::now()->format('Y-m-d');

        $max_date = Carbon::parse($current_date)->addDays(30);
        $max_date->toDateString();

        $val = $request->validate([
            'date' => 'bail|required|after:today|before:'.$max_date, 
        ],[
            'date.required' => 'Whoops, gelieve een datum in te geven.',
            'date.before' => 'De maximum uitleentermijn is 20 dagen.',
            'date.after' => 'Hmm wij hebben geen tijdsmachine... probeer een datum in de toekomst.',
        ]);

        $request->session()->put('end_date', $val['date']);
        return redirect('/user');
    }
}
