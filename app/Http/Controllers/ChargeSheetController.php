<?php

namespace App\Http\Controllers;

use App\Models\misdeed;
use App\Models\station;
use App\Models\station_user;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ChargeSheetController extends Controller
{
    public function chargesheet($id){
        $case = misdeed::find($id);

        $station_id = station_user::where('user_id',$case->agent)->first();
        $station = station::find($station_id->station_id);
        $pdf = PDF::loadView('chargesheet',compact('case','station'));
        return $pdf->download("$case->offender_name case $case->id chargesheet.pdf");
    }
}
