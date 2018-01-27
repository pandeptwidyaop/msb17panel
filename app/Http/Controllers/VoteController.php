<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index(){
      $data = DB::table('votes')
      ->select('candidates.number','candidates.name',DB::raw('count(votes.ticket_id) as total'))
      ->join('candidates','candidates.id','=','votes.candidate_id')
      ->groupBy('candidates.number','candidates.name')
      ->orderBy('total','desc')
      ->get();
      return view('vote.index',compact('data'));
    }
}
