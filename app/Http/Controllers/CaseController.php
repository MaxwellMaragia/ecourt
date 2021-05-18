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
            return view('police.home',compact('offences','courts'));
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
            $total_cases = misdeed::where('agent',Auth::user()->id)->get();
            $solved_cases = misdeed::where('agent',Auth::user()->id)->whereNotNull('magistrate_decision')->get();
            $pending_cases = misdeed::where('agent',Auth::user()->id)->whereNull('magistrate_decision')->get();
            $recent_cases = misdeed::where('agent',Auth::user()->id)->whereNull('magistrate_decision')->take(3)->get();

            return view('police.home',compact('offences','courts','total_cases','solved_cases','recent_cases','pending_cases'));
        }
        else{
            redirect(route('login'));
        }
    }

    public function total()
    {
        if(Auth::user()->category == 'agent'){

            $total_cases = misdeed::where('agent',Auth::user()->id)->paginate(5);
            $total = misdeed::where('agent',Auth::user()->id)->count();
            return view('police.cases.total',compact('total_cases','total'));
        }
        else{
            redirect(route('login'));
        }
    }

    public function pending()
    {
        if(Auth::user()->category == 'agent'){

            $total_cases = misdeed::where('agent',Auth::user()->id)->whereNotNull('magistrate_decision')->paginate(5);
            $total = misdeed::where('agent',Auth::user()->id)->whereNotNull('magistrate_decision')->count();
            return view('police.cases.pending',compact('total_cases','total'));
        }
        else{
            redirect(route('login'));
        }
    }

    public function closed()
    {
        if(Auth::user()->category == 'agent'){

            $total_cases = misdeed::where('agent',Auth::user()->id)->whereNull('magistrate_decision')->paginate(5);
            $total = misdeed::where('agent',Auth::user()->id)->whereNull('magistrate_decision')->count();
            return view('police.cases.closed',compact('total_cases','total'));
        }
        else{
            redirect(route('login'));
        }
    }

    public function accepts()
    {
        if(Auth::user()->category == 'agent'){
            $offences = offence::all();
            $courts = court::all();
            return view('police.accepted',compact('offences','courts'));
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
            return view('police.denied',compact('offences','courts'));
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

        $this->validate($request,[
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'video' => 'video|mimes:mp4,ogx,oga,ogv,ogg,webm|max:30000',
            'names' => 'required|max:30|min:5|string',
            'id' => 'required|digits:8',
            'mobile' => 'required|digits:12',

        ]);

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

        foreach(Auth::User()->stations as $key => $station){
            $court_id = $station->court->id;
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
            'court'=>$court_id,
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

        $number = $misdeed->id;
        return redirect(route('success'))->with('number',$number)->with('message','submit');
        //return route('success')->with('number',$number);
    }

    public function denied(Request $request)
    {

        $this->validate($request,[
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'video' => 'video|mimes:mp4,ogx,oga,ogv,ogg,webm|max:30000',
            'names' => 'required|max:30|min:5|string',
            'id' => 'required|digits:8',
            'mobile' => 'required|digits:12',

        ]);

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

        foreach(Auth::User()->stations as $key => $station){
            $court_id = $station->court->id;
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
            'court'=>$court_id,
            'court_appearance_date'=>$request->court_appearance_date,
            'bail'=>$request->bail,
            'offender_decision'=>0

        );

        $misdeed = misdeed::create($data);
        $misdeed->offences()->sync($request->charge);
        $message = "Hello ".$request->names.", A case with case number ".$misdeed->id." has been opened for you, your bail amount is ".$request->bail." and court appearance date is ".$request->court_date;

        Nexmo::message()->send([
            'to'   => $request->mobile,
            'from' => '254707338839',
            'text' => $message
        ]);

        $number = $misdeed->id;
        return redirect(route('success'))->with('number',$number)->with('message','submit');
        //return route('success')->with('number',$number);
    }

    public function success(){
        if(session('number')){
            return view('police.success');
        }else{
            return redirect(route('home'));
        }
    }

    public function edit($id)
    {
        $case = misdeed::find($id);
        $offences = offence::all();
        return view('police.edit',compact('case','offences'));
    }

    public function show($id)
    {
        $case = misdeed::find($id);
        $offences = offence::all();
        return view('police.cases.case',compact('case'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'video' => 'video|mimes:mp4,ogx,oga,ogv,ogg,webm|max:30000',
            'names' => 'required|max:30|min:5|string',
            'id' => 'required|digits:8',
        ]);

        $misdeed = misdeed::find($id);

        if($request->dismissed){
            $dismissed = $request->dismissed;
        }else{
            $dismissed = 0;
        }

        if($request->hasFile('image'))
        {
            $image = $request->image->store('public/files/cases');
        }
        else{
            $image = $misdeed->image;
        }

        if($request->hasFile('video'))
        {
            $video = $request->video->store('public/files/cases');
        }else{
            $video = $misdeed->video;
        }

        $data = array(
            'offender_name' => $request->names,
            'identification' => $request->id,
            'nationality' => $request->nationality,
            'address' => $request->address,
            'license_number' => $request->dl,
            'age' => $request->age,
            'gender' => $request->gender,
            'car_registration' => $request->car_registration,
            'offence_location' => $request->incident_location,
            'particulars' => $request->particulars,
            'mitigating' => $request->mitigating,
            'agent' => Auth::user()->id,
            'image'=>$image,
            'video'=>$video,
            'dismissed'=>$dismissed,
            'offender_decision'=>1

        );

        misdeed::where('id',$id)->update($data);
        $misdeed->offences()->sync($request->charge);

        if($request->dismissed){
            $message = "Hello ".$request->names.", Your case with case number ".$misdeed->id." has been updated and you have been pardoned";
        }else{
            $message = "Hello ".$request->names.", Your case with case number ".$misdeed->id." has been updated";
        }

        Nexmo::message()->send([
            'to'   => $request->mobile,
            'from' => '254707338839',
            'text' => $message
        ]);

        $number = $misdeed->id;
        return redirect(route('success'))->with('number',$number)->with('message','update');
    }

    public function assignProsecutor(Request $request, $id)
    {
        $misdeed = misdeed::find($id);
        $misdeed->status = $request->status;
        $misdeed->save();
        $message = "Hello ".$misdeed->offender_name.", your case with case number ".$misdeed->id." has been set as valid, you will receive feedback in due time";

        Nexmo::message()->send([
            'to'   => $misdeed->offender_mobile,
            'from' => '254707338839',
            'text' => $message
        ]);

        return redirect()->back()->with('success', 'Case verdict selected');
    }

    public function destroy($id)
    {
        //
        $misdeed = misdeed::find($id);
        $number = $misdeed->id;
        $misdeed->delete();
        $misdeed->offences()->detach();
        $message = "Hello ".$misdeed->offender_name.", Your case with case number ".$misdeed->id." has been dropped and deleted.";
        Nexmo::message()->send([
            'to'   => $misdeed->offender_mobile,
            'from' => '254707338839',
            'text' => $message
        ]);
        return redirect(route('success'))->with('number',$number)->with('message','delete');
    }

    public function search(Request $request){
        $cases = misdeed::where('identification',$request->id)->paginate(5);
        $total = misdeed::where('identification',$request->id)->count();
        $id = $request->id;
        return view('police.cases.search',compact('cases','total','id'));
    }


}
