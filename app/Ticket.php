<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    
    protected $fillable = [
      'number',
      'unique_number'
    ];

    public function Vote()
    {
        return $this->hasOne('App\Vote');
    }

    public function TicketAccess(){
      return $this->hasOne('App\TicketAccess');
    }
}
