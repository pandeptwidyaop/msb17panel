<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionTwo extends Model
{
    protected $fillable = [
      'candidate_id',
      'ketepatan_jawaban',
      'visi_misi',
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
