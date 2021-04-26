<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class misdeed extends Model
{
    use HasFactory;
    use Notifiable;

    public function offences()
    {
        return $this->belongsToMany('App\Models\offence','misdeed_offences');
    }

    public function routeNotificationForAfricasTalking($notification)
    {
        return $this->offender_mobile;
    }
}
