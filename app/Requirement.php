<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    public function service()
    {
        return $this->belongsTo('App\Service');
    }
    public function files()
    {
        return $this->hasMany('App\File');
    }

}
