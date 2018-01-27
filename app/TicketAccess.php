<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketAccess extends Model
{

    protected $fillable = ['unique_number','user_id'];

    public function Ticket(){
      return $this->belongsTo('App\Ticket');
    }

    public function User(){
      return $this->belongsTo('App\User');
    }
}
