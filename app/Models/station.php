<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class station extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany('App\Models\User','station_users');
    }
}
