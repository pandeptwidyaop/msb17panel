<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use App\Talent;
use Auth;
use Session;

class TalentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Talent::where('user_id',Auth::user()->id)->get();
        return view('talent.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $a = Talent::select('candidate_id')->where('user_id',Auth::user()->id)->get();
        $data = [];
        foreach ($a as $key) {
          $data[] = $key->candidate_id;
        }
        $candidate = Candidate::whereNotIn('id',$data)->orderby('number','asc')->get();
        return view('talent.add',compact('candidate'));
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
        $tal = new Talent;
        $tal->fill($data);
        if ($tal->save()) {
          Session::flash('alert','Berhasil menyimpan data nilai.');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menyimpan data nilai.');
          Session::flash('alert-class','alert-danger');
        }
        return redirect(url(Auth::user()->role.'/assessment/talent'));
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
