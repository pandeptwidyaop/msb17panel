<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionThree extends Model
{
    protected $fillable = [
      'candidate_id',
      'kemampuan_logika_berpikir',
      'ketepatan_jawaban',
      'catwalk',
      'body_language',
      'ekspresi',
      'kecantikan',
      'public_speaking',
      'sikap',
      'percaya_diri',
      'user_id'
    ];

    public function Candidate(){
      return $this->belongsTo('App\Candidate');
    }

    public function User(){
      return $this->belongsTo('App\User');
    }
}
