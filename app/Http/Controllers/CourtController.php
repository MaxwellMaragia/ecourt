<?php

namespace App\Http\Controllers;

use App\Models\court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->category == 'super admin') {
            $courts = court::all();
            return view('super admin.court.show', compact('courts'));
        }
        else{
            redirect(route('login'));
        }

    }


    public function create()
    {
        //
        if (Auth::user()->category == 'super admin') {
            return view('super admin.court.create');
        }
        else{
            redirect(route('login'));
        }

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:courts'
        ]);

        $court = new court();
        $court->name = $request->name;
        $court->location = $request->location;

        $court->save();
        return (redirect()->back()->with('success', 'court saved successfully'));

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (Auth::user()->category == 'super admin') {
            $court = court::where('id', $id)->first();
            return view('super admin.court.edit', compact('court'));
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

        $court = court::find($id);
        $court->name = $request->name;
        $court->location = $request->location;
        $court->save();

        return redirect()->back()->with('success', 'Update was successful');
    }

    public function destroy($id)
    {
        if (Auth::user()->court == 'super admin') {
            court::where('id', $id)->delete();
            return redirect()->back()->with('success', 'court deleted successfully');
        }
        else{
            return route('login');
        }
    }
}
