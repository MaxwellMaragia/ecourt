<?php

namespace App\Http\Controllers;

use App\Models\court;
use App\Models\station;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
          if(Auth::user()->password_changed_at == NULL){
              return redirect(url('changepassword'));
          }
          else{
              if(Auth::user()->category == 'super admin'){
                  $station_admins = User::where('category','station admin')->get();
                  $court_admins = User::where('category','court admin')->get();
                  $stations = station::all();
                  $courts = court::all();
                  return view('super admin.home',compact('station_admins','court_admins','stations','courts'));
              }
              else if(Auth::user()->category == 'station admin'){
                  return redirect(route('agents.index'));
              }
              else if(Auth::user()->category == 'court admin'){
                  return redirect(route('magistrates.index'));
              }
              else if(Auth::user()->category == 'agent'){
                  return redirect(route('cases.create'));
              }
              else if(Auth::user()->category == 'magistrate'){
                  return view('magistrate.home');
              }
              else if(Auth::user()->category == 'prosecutor'){
                  return view('prosecutor.home');
              }
              else{
                  return redirect(route('login'));
              }
          }
    }
}
