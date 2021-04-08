<?php

namespace App\Http\Controllers;

use App\Models\court;
use App\Models\court_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MagistrateController extends Controller
{


    public function index()
    {
        if (Auth::user()->category == 'court admin') {
            //get court id
            $user_id = Auth::user()->id;
            $court_id = court_user::where('user_id',$user_id)->first();

            $court = court::where('id',$court_id->court_id)->first();

            $magistrates = $court->users()->get();

            return view('court admin.magistrates.show',compact('magistrates'));
        }
        else{
            redirect(route('login'));
        }

    }

    public function create()
    {
        //
        if (Auth::user()->category == 'court admin') {
            return view('court admin.magistrates.create');
        }
        else{
            redirect(route('login'));
        }

    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'staff_id' => ['required', 'string', 'max:12','unique:users']
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->staff_id = $request->staff_id;
        $user->category = $request->category;
        $user->password = Hash::make($request->staff_id);
        $user->save();

        $user_id = Auth::user()->id;
        $court_user = court_user::where('user_id',$user_id)->first();


        $court_id = $court_user->court_id;


        $user->courts()->sync($court_id);
        return redirect()->back()->with('success',"$request->name's account created successfully'");

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        if (Auth::user()->category == 'court admin') {
            $magistrate = User::where('id', $id)->first();
            return view('court admin.magistrates.edit', compact('magistrate'));
        }
        else{
            redirect(route('login'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'staff_id' => ['required', 'string', 'max:12']
        ]);


    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'magistrate deleted successfully');
    }
}
