<?php

namespace App\Http\Controllers;

use App\Models\offence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->category == 'super admin'){
            $offences = offence::all();
            return view('super admin.offence.show',compact('offences'));
        }
        else{
            redirect(route('login'));
        }
    }

    public function create()
    {
        if(Auth::user()->category == 'super admin'){
            return view('super admin.offence.create');
        }
        else{
            redirect(route('login'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'offence' => ['required', 'string','unique:offences']
        ]);

        $offence = new offence();
        $offence->offence = $request->offence;
        $offence->fine = $request->fine;
        $offence->bail = $request->bail;
        $offence->save();
        return redirect()->back()->with('success',"Offence created successfully'");

    }

    public function edit($id)
    {
        if(Auth::user()->category == 'super admin'){
            $offence = offence::where('id', $id)->first();
            return view('super admin.offence.edit', compact('offence'));

        }
        else{
            redirect(route('login'));
        }
    }

    public function update(Request $request, $id)
    {


        $offence = offence::find($id);
        $offence->fine = $request->fine;
        $offence->bail = $request->bail;
        $offence->save();
        return redirect()->back()->with('success', 'Offence updated successfully');

    }

    public function destroy($id)
    {
        //
        offence::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Offence deleted successfully');
    }
}
