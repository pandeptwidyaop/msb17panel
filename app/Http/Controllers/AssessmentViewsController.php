<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentViewsController extends Controller
{
    public function index(){
      $interview = DB::table('interviews')
      ->select('candidates.number','candidates.name','candidates.id',
        DB::raw('sum((interviews.kemampuan_logika_berpikir * 0.25) + (interviews.kemampuan_menjawab_pertanyaan * 0.25) + (interviews.komunikatif * 0.25) + (interviews.percaya_diri * 0.25)) as total')
      )
      ->join('candidates','candidates.id','interviews.candidate_id')
      ->groupBy('candidates.number','candidates.name','candidates.id')
      ->orderBy('total','desc')
      ->get();

      $tahap1 = DB::table('section_ones')
        ->select('candidates.number','candidates.name','candidates.id',
          DB::raw('sum(((((((interviews.kemampuan_logika_berpikir * 0.25) + (interviews.kemampuan_menjawab_pertanyaan * 0.25) + (interviews.komunikatif * 0.25) + (interviews.percaya_diri * 0.25)) * 0.5) + (section_ones.kemampuan_menjawab_pertanyaan * 0.5)) * 0.3) + (((section_ones.fashion_show * 0.2 ) + (section_ones.catwalk * 0.2) + (section_ones.body_language * 0.2) + (section_ones.ekspresi * 0.2) + (section_ones.kecantikan * 0.2)) * 0.35) + (((section_ones.public_speaking * 0.4) + (section_ones.sikap * 0.3) + (section_ones.percaya_diri * 0.3)) * 0.35))) as total')
        )
        ->join('interviews','interviews.id','section_ones.interview_id')
        ->join('candidates','candidates.id','interviews.candidate_id')
        ->groupBy('candidates.number','candidates.name','candidates.id')
        ->orderBy('total','desc')
        ->limit(16)
        ->get();

      $minat = DB::table('talents')
        ->select('candidates.id','candidates.name','candidates.number',
          DB::raw('sum(talents.minat_bakat) as total')
        )
        ->join('candidates','candidates.id','talents.candidate_id')
        ->groupBy('candidates.id','candidates.name','candidates.number')
        ->orderBy('total','desc')
        ->get();
      $tahap2 = DB::table('section_twos')
        ->select('candidates.id','candidates.name','candidates.number',
          DB::raw('sum(((((section_twos.ketepatan_jawaban * 0.5)+(section_twos.visi_misi * 0.5))* 0.3)+(((section_twos.catwalk * 0.25)+(section_twos.body_language * 0.25) + (section_twos.ekspresi * 0.25) + (section_twos.kecantikan * 0.25))* 0.35)+(((section_twos.public_speaking * 0.4)+(section_twos.sikap * 0.3) + (section_twos.percaya_diri * 0.3))* 0.35))) as total')
        )
        ->join('candidates','candidates.id','section_twos.candidate_id')
        ->groupBy('candidates.id','candidates.name','candidates.number')
        ->orderBy('total','desc')
        ->limit(8)
        ->get();
      $tahap3 = DB::table('section_threes')
        ->select('candidates.id','candidates.name','candidates.number',
            DB::raw('sum((((section_threes.kemampuan_logika_berpikir * 0.5)+(section_threes.ketepatan_jawaban))*0.3) + (((section_threes.catwalk * 0.25)+(section_threes.body_language * 0.25)+(section_threes.ekspresi * 0.25) + (section_threes.kecantikan * 0.25))*0.35) + (((section_threes.public_speaking * 0.4)+(section_threes.sikap * 0.3)+(section_threes.percaya_diri * 0.3))*0.35)) as total')
          )
        ->join('candidates','candidates.id','section_threes.candidate_id')
        ->groupBy('candidates.id','candidates.name','candidates.number')
        ->orderBy('total','desc')
        ->limit(3)
        ->get();
      return view('assessment.views.index',compact('interview','tahap1','minat','tahap2','tahap3'));
    }


}
