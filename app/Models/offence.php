<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offence extends Model
{
    use HasFactory;
    public function misdeeds()
    {
        return $this->belongsToMany('App\Models\misdeed','misdeed_offences');
    }
}
