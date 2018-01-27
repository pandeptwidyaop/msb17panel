<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\SectionOne;
use App\Interview;
use Illuminate\Support\Facades\DB;


class SectionOneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = DB::table('section_ones')
        ->select('candidates.*','section_ones.*',
          DB::raw('((interviews.kemampuan_logika_berpikir * 0.25) + (interviews.kemampuan_menjawab_pertanyaan * 0.25) + (interviews.komunikatif * 0.25) + (interviews.percaya_diri * 0.25)) as wawancara'),
          DB::raw('((((((interviews.kemampuan_logika_berpikir * 0.25) + (interviews.kemampuan_menjawab_pertanyaan * 0.25) + (interviews.komunikatif * 0.25) + (interviews.percaya_diri * 0.25)) * 0.5) + (section_ones.kemampuan_menjawab_pertanyaan * 0.5)) * 0.3) + (((section_ones.fashion_show * 0.2 ) + (section_ones.catwalk * 0.2) + (section_ones.body_language * 0.2) + (section_ones.ekspresi * 0.2) + (section_ones.kecantikan * 0.2)) * 0.35) + (((section_ones.public_speaking * 0.4) + (section_ones.sikap * 0.3) + (section_ones.percaya_diri * 0.3)) * 0.35)) as total')
          )
        ->join('interviews','interviews.id','section_ones.interview_id')
        ->join('candidates','candidates.id','interviews.candidate_id')
        ->where('section_ones.user_id',Auth::user()->id)
        ->orderBy('total','desc')
        ->get();
        return view('sectionone.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $id = Sectionone::select('interview_id')->where('user_id',Auth::user()->id)->get();
      $data = [];
      foreach ($id as $key) {
        $data[] = $key->interview_id;
      }
      $inter = Interview::whereNotIN('id',$data)->where('user_id',Auth::user()->id)->get();
      return view('sectionone.add',compact('inter'));
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
      $sect = new SectionOne;
      $sect->fill($data);
      if ($sect->save()) {
        Session::flash('alert','Berhasil menyimpan data nilai.');
        Session::flash('alert-class','alert-success');
      }else {
        Session::flash('alert','Gagal menyimpan data nilai.');
        Session::flash('alert-class','alert-danger');
      }
      return redirect(url(Auth::user()->role.'/assessment/sectionone'));
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
