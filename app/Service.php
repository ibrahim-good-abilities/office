<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
    public function requirements()
    {
        return $this->hasMany('App\Requirement');
    }
}
