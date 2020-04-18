<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Items;
use App\Rentals;

use Illuminate\Http\Request;

class ReturnController extends Controller
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
     * Return view
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('indienen/indienen');
    }

    /**
     * Validate input & pass to check
     *
     * @return \Illuminate\Http\Response
     */
    public function set(Request $request)
    {
        $validate = $request->validate([
            'id_toestel' => [
                'required',
                'exists:items',
                Rule::exists('items')->where(function ($query) {
                    $query->where('is_available', 0);
                }),
            ]
        ],[
            'id_toestel.required' => 'Whoops, gelieve een code in te geven.',
            'id_toestel.exists' => 'Whoops, geen match gevonden, heb je zeker de juiste code ingegeven?',
        ]);

        $item = Rentals::where('id_toestel', $validate['id_toestel'])->first();

        return view('indienen/opmerkingen',  compact('item'));
    }

    /**
     * Update db record
     *
     * @return \Illuminate\Http\Response
     */
    public function final(Request $request)
    {
        $status = $request->input('status');
        $id = $request->input('id_toestel');
        $opmerkingen = $request->input('opmerkingen');
        $output = '';

        switch ($status) {
            case 0:
                $output = 'Opmerking: (defect) ' . $opmerkingen;
                break;
            case 1:
                $output = 'Opmerking: (beschadigd) ' . $opmerkingen;
                break;
            case 2:
                $output = $opmerkingen;
                break;
        }

        $current_date = Carbon::now()->format('Y-m-d');

        Items::where('id_toestel', $id)->update([
            'is_available' => 1,
        ]);

        Rentals::where('id_toestel', $id)->where('is_active', '1')->update([
            'is_active' => 0,
            'opmerkingen' => $output,
            'terug_datum' => $current_date,
        ]);

        return redirect('/home');
    }
}
