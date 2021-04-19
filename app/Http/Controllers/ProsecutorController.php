<?php

namespace App\Http\Controllers;

use App\Models\court;
use App\Models\court_user;
use App\Models\misdeed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProsecutorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        //
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
        $court = court_user::where('user_id',$user_id)->first();
        $court_id = $court->court_id;
        $users = User::where('category','magistrate')->get();

        //$users = User::join('users','users.id','=','court_user.user_id')->select('user.*','court_user.court_id as cid')->get();



//       foreach($magistrate_ids as $magistrate_id){
//
//            $magistrates = User::where('id',$magistrate_id->user_id)->get()->toArray();
//
//
//        }

        return view('prosecutor.cases.case',compact('case','users','court_id'));
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
        }else if($request->outcome == 0){
           $misdeed->prosecutor_decision = $request->outcome;
        }

        $misdeed->prosecutor_decision_reason = $request->outcome;
        $misdeed->save();

        return redirect()->back()->with('success', 'Case outcome successfully saved');
    }

    public function destroy($id)
    {
        //
    }
}
