<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    //
    public function home(){
        $partners = Partner::all();
        return view('home',compact('partners'));
    }
}
