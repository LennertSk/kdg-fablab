<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\Items;
use Carbon\Carbon;
use App\Rentals;
use Session;

class FinalRentalController extends Controller
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

        $cart = Session::get('cart');
        $date = Session::get('end_date');
        $user = Session::get('user');

        return view('ontlenen/overzicht', compact('cart', 'date', 'user'));
    }

    /**
     * Validate form input and set date
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function set(Request $request)
    {
        $cart = Session::get('cart');
        $date = Session::get('end_date');
        $user = Session::get('user');

        $current_date = Carbon::now()->format('Y-m-d');

        foreach($cart as $item) {
            Items::where('id_toestel', $item['id_toestel'])->update([
                'is_available' => 0,
            ]);

            $new_rental = new Rentals;
            $new_rental->id_toestel = $item['id_toestel'];
            $new_rental->start_datum = $current_date;
            $new_rental->eind_datum = $date;
            $new_rental->is_active = 1;
            $new_rental->id_ontlener = $user['card'];
            $new_rental->email_ontlener = $user['email'];
            $new_rental->save();
        }

        return redirect('/home');
    }
}
