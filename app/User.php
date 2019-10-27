<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'name', 'email', 'password','role_id','cityId','userAddress','userMobile','userPhone','userJopTitle'
            ,'userIdNum','userIdFile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo('App\Role','roleId');
    }
    public function office()
    {
        return $this->belongsTo('App\Office','officeId');
    }
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
    public function workingDays()
    {
        return $this->hasMany('App\WorkingDay');
    }
    public function city()
    {
        return $this->belongsTo('App\City');
    }

}
