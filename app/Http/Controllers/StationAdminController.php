<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\station;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StationAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->category == 'super admin'){
            $station_admins = User::where('category','station admin')->get();

            return view('super admin.station admin.show',compact('station_admins'));
        }
        else{
            redirect(route('login'));
        }
    }

    public function create()
    {
        $stations = station::all();
        return view('super admin.station admin.create',compact('stations'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'staff_id' => ['required', 'string', 'max:12']
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->avatar = "public/files/profile/avatar.jpg";
        $user->staff_id = $request->staff_id;
        $user->category = 'station admin';
        $user->password = Hash::make($request->staff_id);
        $user->save();
        $user->stations()->sync($request->station);
        return redirect()->back()->with('success',"$request->name's account created successfully'");

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Station admin deleted successfully');
    }
}
