<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\Items;
use Session;

class CardController extends Controller
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

        return view('ontlenen/ontlenen', compact('cart'));
    }

    /**
     * Validate form input and store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $val = $request->validate([
            'id_toestel' => 'bail|required|exists:items|max:255', 
        ],[
            'id_toestel.required' => 'Whoops, gelieve een code in te geven.',
            'id_toestel.exists' => 'Whoops, geen match gevonden, heb je zeker de juiste code ingegeven?',
        ]);

        
        $cart = Session::get('cart');
        
        if(isset($cart)) {
            foreach ($cart as $cart_item) {
                if ( in_array($val['id_toestel'], $cart_item) ){
                    return redirect('ontlenen');
                }
            }
        }

        $getItem = Items::where('id_toestel', $val['id_toestel'])->first();

        $item = [
            'name' => $getItem->name,
            'id_toestel' => $getItem->id_toestel,
            'specificaties' => $getItem->specificaties,
        ];

        Session::push('cart', $item);
        
        return redirect('ontlenen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cart = Session::get('cart'); // Get the array
        unset($cart[$id]); // Unset the index you want
        Session::put('cart', $cart); // Set the array again
        
        return redirect('ontlenen');
    }
}
