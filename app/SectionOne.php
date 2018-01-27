<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionOne extends Model
{
    protected $fillable = [
      'interview_id',
      'kemampuan_menjawab_pertanyaan',
      'fashion_show',
      'catwalk',
      'body_language',
      'ekspresi',
      'kecantikan',
      'public_speaking',
      'sikap',
      'percaya_diri',
      'user_id'
    ];

    public function Interview(){
      return $this->belongsTo('App\Intervew');
    }

    public function User(){
      return $this->belongsTo('App\User');
    }
}
