<?php

namespace App\Http\Controllers;

use App\Models\station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->category == 'super admin') {
            $stations = station::all();
            return view('super admin.station.show', compact('stations'));
        }
        else{
            redirect(route('login'));
        }

    }


    public function create()
    {
        //
        if (Auth::user()->category == 'super admin') {
            return view('super admin.station.create');
        }
        else{
            redirect(route('login'));
        }

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:stations'
        ]);

        $station = new station();
        $station->name = $request->name;
        $station->location = $request->location;

        $station->save();
        return (redirect()->back()->with('success', 'Station saved successfully'));

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (Auth::user()->category == 'super admin') {
            $station = station::where('id', $id)->first();
            return view('super admin.station.edit', compact('station'));
        }
        else{
            redirect(route('login'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $station = station::find($id);
        $station->name = $request->name;
        $station->location = $request->location;
        $station->save();

        return redirect()->back()->with('success', 'Update was successful');
    }

    public function destroy($id)
    {
        if (Auth::user()->station == 'super admin') {
            station::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Station deleted successfully');
        }
        else{
            return route('login');
        }
    }
}
