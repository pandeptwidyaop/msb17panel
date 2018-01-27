<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Candidate()
    {
        return $this->hasMany('App\Candidate');
    }

    public function Interview(){
      return $this->hasMany('App\Intervew');
    }

    public function Talent(){
      return $this->hasMany('App\Talent');
    }

    public function SectionTwo(){
      return $this->hasMany('App\SectionTwo');
    }

    public function SectionThree(){
      return $this->hasMany('App\SectionThree');
    }

    public function TicketAccess(){
      return $this->hasMany('App\TicketAccess');
    }
}
