<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SectionTwo;
use Session;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Candidate;


class SectionTwoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  = DB::table('section_twos')
          ->select('candidates.*','section_twos.*',
            DB::raw('((((section_twos.ketepatan_jawaban * 0.5)+(section_twos.visi_misi * 0.5))* 0.3)+(((section_twos.catwalk * 0.25)+(section_twos.body_language * 0.25) + (section_twos.ekspresi * 0.25) + (section_twos.kecantikan * 0.25))* 0.35)+(((section_twos.public_speaking * 0.4)+(section_twos.sikap * 0.3) + (section_twos.percaya_diri * 0.3))* 0.35)) as total'
            ))
          ->join('candidates','candidates.id','section_twos.candidate_id')
          ->where('section_twos.user_id',Auth::user()->id)
          ->get();
          return view('sectiontwo.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $dataIn = [];
      $dataEx = [];
        $top = DB::table('section_ones')
          ->select('candidates.id',
            DB::raw('sum(((((((interviews.kemampuan_logika_berpikir * 0.25) + (interviews.kemampuan_menjawab_pertanyaan * 0.25) + (interviews.komunikatif * 0.25) + (interviews.percaya_diri * 0.25)) * 0.5) + (section_ones.kemampuan_menjawab_pertanyaan * 0.5)) * 0.3) + (((section_ones.fashion_show * 0.2 ) + (section_ones.catwalk * 0.2) + (section_ones.body_language * 0.2) + (section_ones.ekspresi * 0.2) + (section_ones.kecantikan * 0.2)) * 0.35) + (((section_ones.public_speaking * 0.4) + (section_ones.sikap * 0.3) + (section_ones.percaya_diri * 0.3)) * 0.35))) as total')
          )
          ->join('interviews','interviews.id','section_ones.interview_id')
          ->join('candidates','candidates.id','interviews.candidate_id')
          ->groupBy('candidates.id')
          ->orderBy('total','desc')
          ->limit(16)
          ->get();
        $section = SectionTwo::where('user_id',Auth::user()->id)->get();
        foreach ($top as $key) {
          $dataIn[] = $key->id;
        }
        foreach ($section as $key) {
          $dataEx[] = $key->candidate_id;
        }
        $candidate = Candidate::whereIn('id',$dataIn)->whereNotIn('id',$dataEx)->orderBy('number','asc')->get();
        //return dd($candidate);
        return view('sectiontwo.add',compact('candidate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $st = new SectionTwo;
        $st->fill($data);
        if ($st->save()) {
          Session::flash('alert','Berhasil menyimpan data nilai.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menyimpan data nilai.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect(Auth::user()->role.'/assessment/sectiontwo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
