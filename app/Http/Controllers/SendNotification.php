<?php

namespace App\Http\Controllers;

use Nexmo\Laravel\Facade\Nexmo;

class SendNotification extends Controller
{
    //
    public function sendSms($mobile_number,$message){
        Nexmo::message()->send([
            'to'   => $mobile_number,
            'from' => '16105552344',
            'text' => $message
        ]);
    }
}
