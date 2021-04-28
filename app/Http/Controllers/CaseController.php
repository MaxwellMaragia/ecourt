<?php

namespace App\Http\Controllers;

use App\Models\court;
use App\Models\court_user;
use App\Models\misdeed;
use App\Models\offence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nexmo\Laravel\Facade\Nexmo;

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



          if($request->dismissed){
              $dismissed = $request->dismissed;
          }else{
              $dismissed = 0;
          }

          if($request->hasFile('image'))
          {
              $image = $request->image->store('public/files/cases');
          }else{
              $image = "public/files/cases/noimage.png";
          }

          if($request->hasFile('video'))
          {
              $video = $request->video->store('public/files/cases');
          }else{
              $video = NULL;
          }

        $data = array(
            'offender_name' => $request->names,
            'identification' => $request->id,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'offender_mobile' => $request->mobile,
            'license_number' => $request->dl,
            'age' => $request->age,
            'gender' => $request->gender,
            'car_registration' => $request->car_registration,
            'offence_location' => $request->incident_location,
            'time' => $request->time,
            'particulars' => $request->particulars,
            'mitigating' => $request->mitigating,
            'agent' => Auth::user()->id,
            'image'=>$image,
            'video'=>$video,
            'dismissed'=>$dismissed,
            'offender_decision'=>1

        );

          $misdeed = misdeed::create($data);
          $misdeed->offences()->sync($request->charge);

        if($request->dismissed){
            $message = "Hello ".$request->names.", A case with case number ".$misdeed->id." has been opened for you, however you have been pardoned";
        }else{
            $message = "Hello ".$request->names.", A case with case number ".$misdeed->id." has been opened for you and is awaiting prosecutor decision";
        }
          Nexmo::message()->send([
                'to'   => $request->mobile,
                'from' => '254707338839',
                'text' => $message
            ]);
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
        $message = "Hello ".$misdeed->offender_name.", your case with case number ".$misdeed->id." has been assigned a prosecutor, you will receive feedback in due time";

        Nexmo::message()->send([
            'to'   => $misdeed->offender_mobile,
            'from' => '254707338839',
            'text' => $message
        ]);
        return redirect()->back()->with('success', 'Prosecutor for case selected');
    }

    public function destroy($id)
    {
        //
    }


}
