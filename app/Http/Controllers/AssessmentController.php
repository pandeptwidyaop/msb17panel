<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use Auth;
use DB;
use Session;

class AssessmentController extends Controller
{


    public function index(){
      return view('assessment.index');
    }


}
