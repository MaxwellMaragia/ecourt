<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Profile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changepassword(Request $request){
        $this->validate($request,[
            'password' => [
                'confirmed',
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->password_changed_at = now();
        $user->save();
        return redirect(route('home'));
    }

    public function create()
    {
        return view('auth.passwords.changepassword');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
        if(Auth::user()->id == $id){
            $user = User::find($id);
            if(Auth::user()->category == 'super admin'){
                return view('super admin.profile.edit',compact('user'));
            }
            else if(Auth::user()->category == 'station admin'){
                return view('station admin.profile.edit',compact('user'));
            }
            else if(Auth::user()->category == 'court admin'){
                return view('court admin.profile.edit',compact('user'));
            }
            else if(Auth::user()->category == 'agent'){
                return view('police.profile',compact('user'));
            }
            else if(Auth::user()->category == 'magistrate'){
                return view('magistrate.profile.edit',compact('user'));
            }
            else if(Auth::user()->category == 'prosecutor'){
                return view('prosecutor.profile.edit',compact('user'));
            }


        }else{
            return route('login');
        }

    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'password' => ['confirmed'],
            'file' => ['image','mimes:jpeg,png,jpg,gif,svg','max:5048']
        ]);


        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;


        if($request->filled('password'))
        {
            $user->password = Hash::make($request->password);
        }
        if($request->hasFile('file'))
        {
            $user->avatar = $request->file->store('public/files/profile');
        }

        $user->save();

        return redirect()->back()->with('success',"Your account updated successfully'");

    }


    public function destroy($id)
    {
        //
    }
}
