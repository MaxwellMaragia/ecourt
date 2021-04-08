<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class misdeed extends Model
{
    use HasFactory;
    public function offences()
    {
        return $this->belongsToMany('App\Models\offence','misdeed_offences');
    }
}
