<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
      'id',
      'number',
      'name',
      'place_of_birth',
      'date_of_birth',
      'religion',
      'address',
      'phone_number',
      'campus',
      'study_program',
      'semester',
      'organization',
      'organization_experience',
      'achievements',
      'interest_talents',
      'reason',
      'social_media',
      'picture',
      'user_id'
    ];

    public function Vote()
    {
      return $this->hasMany('App\Vote');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }



    public function Interview(){
      return $this->hasMany('App\Interview');
    }
    public function SectionOne(){
      return $this->hasMany('App\SectionOne');
    }
    public function Talent(){
      return $this->hasMany('App\Talent');
    }
    public function SectionTwo(){
      return $this->hasMany('App\SectionTwo');
    }
    public function SetionThree(){
      return $this->hasMany('App\SectionThree');
    }


}
