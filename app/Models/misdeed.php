<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class misdeed extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'offender_name',
        'identification',
        'nationality',
        'address',
        'offender_mobile',
        'license_number',
        'age',
        'gender',
        'car_registration',
        'offence_location',
        'time',
        'offender_decision',
        'particulars',
        'mitigating',
        'agent',
        'image',
        'video',
        'dismissed',
        'court',
        'court_appearance_date',
        'fine',
        'bail',

    ];


    public function offences()
    {
        return $this->belongsToMany('App\Models\offence','misdeed_offences');
    }
}
