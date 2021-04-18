<?php

namespace App\Http\Controllers;

use App\Models\court;
use App\Models\court_user;
use App\Models\misdeed;
use App\Models\offence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->category == 'agent'){
            $offences = offence::all();
            $courts = court::all();
            return view('agent.home',compact('offences','courts'));
        }
        else{
            redirect(route('login'));
        }
    }


    public function create()
    {
        if(Auth::user()->category == 'agent'){
            $offences = offence::all();
            $courts = court::all();
            return view('agent.home',compact('offences','courts'));
        }
        else{
            redirect(route('login'));
        }
    }

    public function accepts()
    {
        if(Auth::user()->category == 'agent'){
            $offences = offence::all();
            return view('agent.accepted',compact('offences'));
        }
        else{
            redirect(route('login'));
        }
    }
    public function denies()
    {
        if(Auth::user()->category == 'agent'){
            $offences = offence::all();
            $courts = court::all();
            return view('agent.denied',compact('offences','courts'));
        }
        else{
            redirect(route('login'));
        }
    }

    //For fetching states
    public function getProsecutors($id)
    {
        $court = court::where('id',$id)->first();

        $prosecutors = $court->users()->where('users.category','prosecutor')->pluck("users.name","users.id")->all();
        return response()->json($prosecutors);
    }


    public function store(Request $request)
    {
          $misdeed = new misdeed();
          $misdeed->offender_name = $request->names;
          $misdeed->identification = $request->id;
          $misdeed->nationality = $request->nationality;
          $misdeed->address = $request->address;
          $misdeed->offender_mobile = $request->mobile;
          $misdeed->license_number = $request->dl;
          $misdeed->age = $request->age;
          $misdeed->gender = $request->gender;
          $misdeed->car_registration = $request->car_registration;
          $misdeed->offence_location = $request->incident_location;
          $misdeed->time = $request->time;
          $misdeed->particulars = $request->particulars;
          $misdeed->mitigating = $request->mitigating;
          $misdeed->agent = Auth::user()->id;
          $misdeed->dismissed = $request->dismissed;
          $misdeed->offender_decision = 1;
          if($request->hasFile('image'))
          {
              $misdeed->image = $request->image->store('public/files/cases');
          }

          if($request->hasFile('video'))
          {
                $misdeed->video = $request->video->store('public/files/cases');
          }

          $misdeed->save();
          $misdeed->offences()->sync($request->charge);

          return redirect()->back()->with('success',"Case has been submitted");


    }



    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function assignProsecutor(Request $request, $id)
    {
        $misdeed = misdeed::find($id);
        $misdeed->prosecutor = $request->prosecutor;
        $misdeed->save();

        return redirect()->back()->with('success', 'Prosecutor for case selected');
    }

    public function destroy($id)
    {
        //
    }


}
