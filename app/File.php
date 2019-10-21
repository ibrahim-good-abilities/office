<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function requirement()
    {
        return $this->belongsTo('App\Requirement');
    }
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
