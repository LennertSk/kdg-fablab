<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Items;
use App\Rentals;
use Carbon\Carbon;

class AdminController extends Controller
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
     * Return view with values
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // Get values from db
        $users = User::all();
        $items = Items::all();

        return view('admin/dashboard', compact('users', 'items'));
    }

    /**
     * Return users with values
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        // Get values from db
        $users = User::all();
        return view('admin/dashboard-user', compact('users'));
    }

    /**
     * Return view with user values for edit
     *
     * @return \Illuminate\Http\Response
     */
    public function user($uid)
    {
        $user = User::where('id', $uid)->first();
        return view('admin/user', compact('user', 'user'));
    }

    /**
     * Return view with user values for edit
     *
     * @return \Illuminate\Http\Response
     */
    public function set(Request $request)
    {
        $validate = $request->validate([
            'name' => 'bail|required|',
            'email' => 'bail|required|',
        ]);

        $id = $request->input('id');
        $admin = $request->input('admin');
        if($admin !== '1') {
            $admin = '0';
        }
        User::where('id', $id)->update([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'is_admin' => $admin,
        ]);
        
        return redirect('/dashboard/users');
    }

    /**
     * Delete user from db
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($uid)
    {
        $getUser = User::find($uid);
        $getUser->delete();

        return redirect('/dashboard/users');
    }

    /**
     * Return view with item values for edit
     *
     * @return \Illuminate\Http\Response
     */
    public function info($iid)
    {
        $item = Items::where('id', $iid)->first();
        $info = Rentals::where('id_toestel', $item->id_toestel)->orderBy('terug_datum')->get();

        return view('admin/item', compact('item', 'info'));
    }

    /**
     * Return view with item values for edit
     *
     * @return \Illuminate\Http\Response
     */
    public function itemSet(Request $request)
    {
        $id = $request->input('id');
        $item = Items::where('id', $id)->first();
        $itemId = isset($item) ? $item->id : null;

        $validate = $request->validate([
            'name' => 'bail|required',
            'code' => 'bail|required|unique:items,id_toestel,'. $itemId.',id',
            'specs' => 'required',
            'available' => 'required',
        ]);
        

        Items::where('id', $id)->update([
            'name' => $validate['name'],
            'id_toestel' => $validate['code'],
            'specificaties' => $validate['specs'],
            'is_available' => $validate['available'],
        ]);
        
        return redirect('/dashboard');
    }

    /**
     * Return view with gebruiker
     *
     * @return \Illuminate\Http\Response
     */
    public function gebruiker($uid)
    {
        $user = Rentals::where('id_ontlener', $uid)->get();
        $user_email = Rentals::where('id_ontlener', $uid)->first();
        $user_email = $user_email['email_ontlener'];

        $user_details = [$uid,$user_email];

        return view('admin/client', compact('user', 'user_details'));
    }


    /**
     * Return view with rentals
     *
     * @return \Illuminate\Http\Response
     */
    public function rentals() 
    {
        $items = Items::all();
        $rentals = Rentals::where('is_active', '1')->get();

        $current_date = Carbon::now()->format('Y-m-d');

        $itemsOverdue = array();

        foreach ($rentals as $key=>$item) {
            if (strtotime($item['eind_datum']) < strtotime($current_date)) {
                 
                 
                 array_push( $itemsOverdue, $item);
                 unset($rentals[$key]);
            }
        }
        return view('admin/rentals', compact('items', 'rentals', 'itemsOverdue'));
    }

    /**
     * Return view with add item form
     *
     * @return \Illuminate\Http\Response
     */
    public function addItem()
    {
        return view('admin/add');
    }

    /**
     * Return added item
     *
     * @return \Illuminate\Http\Response
     */
    public function addItemAdd(Request $request)
    {
        $validate = $request->validate([
            'name' => 'bail|required',
            'id_toestel' => 'bail|required|unique:items',
            'specs' => 'required',
        ]);


        $new_item = new Items;
        
        $new_item->name = $validate['name'];
        $new_item->id_toestel = $validate['id_toestel'];
        $new_item->specificaties = $validate['specs'];
        $new_item->location = 'Kdg Fablab';
        $new_item->description = 'lorem';
        $new_item->is_available = '1';
        $new_item->save();

        return redirect('/dashboard');
    }
}




