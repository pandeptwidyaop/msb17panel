<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
      'ticket_id',
      'candidate_id'
    ];

    public function Ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function Candidate()
    {
        return $this->belongsTo('App\Candidate');
    }
}
