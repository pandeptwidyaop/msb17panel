<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    protected $fillable = [
      'candidate_id',
      'minat_bakat',
      'user_id'
    ];

    public function Candidate(){
      return $this->belongsTo('App\Candidate');
    }

    public function User(){
      return $this->belongsTo('App\User');
    }
}
