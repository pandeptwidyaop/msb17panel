<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [
      'candidate_id',
      'kemampuan_logika_berpikir',
      'kemampuan_menjawab_pertanyaan',
      'komunikatif',
      'percaya_diri',
      'user_id'
    ];

    public function Candidate(){
      return $this->belongsTo('App\Candidate');
    }

    public function SectionOne(){
      return $this->hasOne('App\SectionOne');
    }

    public function User(){
      return $this->belongsTo('App\User');
    }
}
