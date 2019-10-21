<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function service()
    {
        return $this->belongsTo('App\Service');
    }
    public function files()
    {
        return $this->hasMany('App\File');
    }

}
