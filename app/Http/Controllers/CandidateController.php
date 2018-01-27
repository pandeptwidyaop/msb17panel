<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use Session;
use Auth;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Candidate::orderBy('number')->get();
        return view('candidate.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidate.add');
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
        $data['date_of_birth'] = date('Y-m-d',strtotime($request->date_of_birth));
        if ($request->hasFile('picture')) {
          $name = Storage::put('public/images',$request->file('picture'));
          $data['picture'] = str_replace('public/','',$name);
        }
        $cand = new Candidate;
        $cand->fill($data);
        if ($cand->save()) {
          Session::flash('alert','Berhasil menambah data kandidat');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menyimpan data kandidat');
          Session::flash('alert-class','alert-danger');
        }
        $prefix = 'admin';
        if (Auth::user()->role == 'crew') {
          $prefix = 'crew';
        }
        return redirect(url($prefix.'/candidate'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Candidate::where('id',$id)->first();
        return view('candidate.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Candidate::where('id',$id)->get();
        return view('candidate.edit',compact('data'));
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
        $data = $request->except('_token','_method');
        $data['date_of_birth'] = date('Y-m-d',strtotime($request->date_of_birth));
        $data['user_id'] = Auth::user()->id;
        if ($request->hasFile('picture')) {
          $request->file('picture');
          $name = Storage::put('public/images',$request->file('picture'));
          $data['picture'] = str_replace('public/','',$name);
        }else {
          $data['picture'] = Candidate::where('id',$id)->first()->picture;
        }
        if (Candidate::where('id',$id)->update($data)) {
          Session::flash('alert','Berhasil menyimpan data kandidat');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menyimpan data kandidat');
          Session::flash('alert-class','alert-danger');
        }
        return redirect(url(Auth::user()->role.'/candidate/'.$id.'/edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate =  Candidate::find($id);
        if ($candidate->forceDelete()) {
          Session::flash('alert','Berhasil menghapus data kandidat');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal menghapus data kandidat');
          Session::flash('alert-class','alert-danger');
        }
        return redirect(url(Auth::user()->role.'/candidate'));
    }
}
