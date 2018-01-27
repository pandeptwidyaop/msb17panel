<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->status == 0) {
          return redirect(url('/profile'));
        }
        $data = Candidate::orderBy('number','asc')->get();
        return view('dashboard',compact('data'));
    }
}
