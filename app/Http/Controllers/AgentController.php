<?php

namespace App\Http\Controllers;

use App\Models\agent;
use App\Models\station;
use App\Models\station_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{

    public function index()
    {
        if (Auth::user()->category == 'station admin') {
            //get station id
            $user_id = Auth::user()->id;
            $station_user = station_user::where('user_id',$user_id)->first();
            $station_id = $station_user->station_id;
            $station = station::find($station_id);

            return view('station admin.agents.show',compact('station'));
        }
        else{
            redirect(route('login'));
        }

    }

    public function create()
    {
        //
        if (Auth::user()->category == 'station admin') {
            return view('station admin.agents.create');
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
        $user->avatar = "public/files/profile/avatar.jpg";
        $user->name = $request->name;
        $user->staff_id = $request->staff_id;
        $user->category = 'agent';
        $user->password = Hash::make($request->staff_id);
        $user->save();

        $user_id = Auth::user()->id;
        $station_user = station_user::where('user_id',$user_id)->first();


        $station_id = $station_user->station_id;


        $user->stations()->sync($station_id);
        return redirect()->back()->with('success',"$request->name's account created successfully'");

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        if (Auth::user()->category == 'station admin') {
            $agent = User::where('id', $id)->first();
            return view('station admin.agents.edit', compact('agent'));
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
        return redirect()->back()->with('success', 'Agent deleted successfully');
    }
}
