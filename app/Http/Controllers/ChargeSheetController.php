<?php

namespace App\Http\Controllers;

use App\Models\misdeed;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ChargeSheetController extends Controller
{
    public function chargesheet($id){
        $case = misdeed::find($id);

        $pdf = PDF::loadView('chargesheet',compact('case'));
        return $pdf->download("$case->offender_name case $case->id chargesheet.pdf");
    }
}
