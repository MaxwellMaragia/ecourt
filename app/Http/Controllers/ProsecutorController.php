<?php

namespace App\Http\Controllers;

use App\Models\court;
use App\Models\court_user;
use App\Models\misdeed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nexmo\Laravel\Facade\Nexmo;

class ProsecutorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function CaseOutcome(Request $request, $id)
    {
        //
    }

    //For fetching states
    public function IndividualCase($id)
    {
        $case = misdeed::where('id',$id)->first();
        //get court id
        $user_id = Auth::user()->id;
        $get_court = court_user::where('user_id',$user_id)->first();
        $court_id = $get_court->court_id;

        $court = court::find($court_id);
        $edit = 1;
        $prosecutor_id = $case->prosecutor;
        $prosecutor = User::find($prosecutor_id);
        $magistrate_id = $case->magistrate;
        $magistrate = User::find($magistrate_id);
        return view('prosecutor.cases.case',compact('case','court','edit','prosecutor','magistrate'));
    }

    //For fetching states
    public function viewCase($id)
    {
        $case = misdeed::where('id',$id)->first();
        //get court id
        $prosecutor_id = $case->prosecutor;
        $prosecutor = User::find($prosecutor_id);
        $magistrate_id = $case->magistrate;
        $magistrate = User::find($magistrate_id);
        $edit = 0;
        return view('prosecutor.cases.case',compact('case','edit','prosecutor','magistrate'));
    }

    public function workedon(){
        $user_id = Auth::user()->id;
        $cases = misdeed::where('prosecutor',$user_id)->get();

        return view('prosecutor.cases.worked_on',compact('cases'));
    }

    public function assignMagistrate(Request $request, $id)
    {
        $this->validate($request, [
            'reason' => 'required'
        ]);

        $misdeed = misdeed::find($id);

        if($request->outcome == 1){
           $misdeed->magistrate = $request->magistrate;
           $misdeed->prosecutor_decision = $request->outcome;
           $message = "Hello ".$misdeed->offender_name.", your case with case number ".$misdeed->id." has been decided as valid and assigned to a magistrate";

        }else if($request->outcome == 0){
           $misdeed->prosecutor_decision = $request->outcome;
           $message = "Hello ".$misdeed->offender_name.", your case with case number ".$misdeed->id." has been decided as invalid and has been dropped";

        }

        $misdeed->prosecutor_decision_reason = $request->reason;
        $misdeed->save();


//        Nexmo::message()->send([
//            'to'   => $misdeed->offender_mobile,
//            'from' => '254707338839',
//            'text' => $message
//        ]);
        return redirect()->back()->with('success', 'Case outcome successfully saved');
    }


}
