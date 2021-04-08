<?php

namespace App\Http\Controllers;

use App\Models\court;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CourtAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->category == 'super admin'){
            $court_admins = User::where('category','court admin')->get();

            return view('super admin.court admin.show',compact('court_admins'));
        }
        else{
            redirect(route('login'));
        }
    }

    public function create()
    {
        $courts = court::all();
        return view('super admin.court admin.create',compact('courts'));
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
        $user->staff_id = $request->staff_id;
        $user->category = 'court admin';
        $user->password = Hash::make($request->staff_id);
        $user->save();
        $user->courts()->sync($request->court);
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
        return redirect()->back()->with('success', 'court admin deleted successfully');
    }
}
