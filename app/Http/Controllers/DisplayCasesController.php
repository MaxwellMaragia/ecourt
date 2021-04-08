<?php

namespace App\Http\Controllers;

use App\Models\court_user;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\misdeed;
use Illuminate\Support\Facades\Auth;

class DisplayCasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function active(){
        if(Auth::user()->category == 'station admin'){
            $user_id = Auth::user()->id;
            $court_id = court_user::where('user_id',$user_id)->first();

            $cases = misdeed::where('dismissed','1')->get();
            return view('station admin.cases.active',compact('cases'));
        }
        else{
            redirect(route('login'));
        }


    }

    public function closed(){

    }

    //For fetching states
    public function IndividualCase($id)
    {
        $case = misdeed::where('id',$id)->first();
        return view('station admin.cases.case',compact('case'));
    }
}
