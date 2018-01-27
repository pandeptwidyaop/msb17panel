<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SectionThree;
use Session;
use Auth;
use App\Candidate;
use Illuminate\Support\Facades\DB;

class SectionThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data  = DB::table('section_threes')
        ->select('candidates.*','section_threes.*',
          DB::raw('((((section_threes.kemampuan_logika_berpikir * 0.5)+(section_threes.ketepatan_jawaban * 0.5))* 0.3)+(((section_threes.catwalk * 0.25)+(section_threes.body_language * 0.25) + (section_threes.ekspresi * 0.25) + (section_threes.kecantikan * 0.25))* 0.35)+(((section_threes.public_speaking * 0.4)+(section_threes.sikap * 0.3) + (section_threes.percaya_diri * 0.3))* 0.35)) as total'
          ))
        ->join('candidates','candidates.id','section_threes.candidate_id')
        ->where('section_threes.user_id',Auth::user()->id)
        ->get();
        return view('sectionthree.index',compact('data'));
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
      $section = SectionThree::where('user_id',Auth::user()->id)->get();
      $top = DB::table('section_twos')
        ->select('candidates.id',
          DB::raw('sum(((((section_twos.ketepatan_jawaban * 0.5)+(section_twos.visi_misi * 0.5))* 0.3)+(((section_twos.catwalk * 0.25)+(section_twos.body_language * 0.25) + (section_twos.ekspresi * 0.25) + (section_twos.kecantikan * 0.25))* 0.35)+(((section_twos.public_speaking * 0.4)+(section_twos.sikap * 0.3) + (section_twos.percaya_diri * 0.3))* 0.35))) as total')
        )
        ->join('candidates','candidates.id','section_twos.candidate_id')
        ->groupBy('candidates.id')
        ->orderBy('total','desc')
        ->limit(8)
        ->get();
        foreach ($top as $key) {
          $dataIn[] = $key->id;
        }
        foreach ($section as $key) {
          $dataEx[] = $key->candidate_id;
        }
        $candidate = Candidate::whereIn('id',$dataIn)->whereNotIn('id',$dataEx)->orderby('number','asc')->get();
        return view('sectionthree.add',compact('candidate'));
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
        $st = new SectionThree;
        $st->fill($data);
        if ($st->save()) {
          Session::flash('alert','Berhasil menyimpan data nilai.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menyimpan data nilai.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect(Auth::user()->role.'/assessment/sectionthree');
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
