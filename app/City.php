<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function offices()
    {
        return $this->hasMany('App\Office');
    }
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
