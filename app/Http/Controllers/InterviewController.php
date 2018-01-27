<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Interview;
use Auth;
use App\Candidate;

class InterviewController extends Controller
{
    public function index(){
      $data = Interview::where('user_id',Auth::user()->id)->get();
      return view('interview.index',compact('data'));
    }

    public function create(){
      $data = Interview::select('candidate_id')->where('user_id',Auth::user()->id)->get();
      $arr = [];
      foreach ($data as $key) {
        $arr[] = $key->candidate_id;
      }
      $candidate = Candidate::whereNotIn('id',$arr)->get();
      return view('interview.add',compact('candidate'));
      //return ($arr);
    }

    public function store(Request $request){
      $data = $request->all();
      $data['user_id'] = Auth::user()->id;
      $interview = new Interview;
      $interview->fill($data);
      if ($interview->save()) {
        Session::flash('alert','Berhasil menyimpan nilai.');
        Session::flash('alert-class','alert-success');
      }else {
        Session::flash('alert','Gagal menyimpan nilai.');
        Session::flash('alert-class','alert-danger');
      }
      return redirect(url(Auth::user()->role.'/assessment/interview'));
    }
}
