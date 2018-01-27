<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('id',Auth::user()->id)->first();
        return view('profile.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $data)
    {
        $profile = User::find(Auth::user()->id);
        //return dd($data->all());
        if (is_null($data->pass1) || is_null($data->pass2)) {
          $profile->name = $data->name;
        }else {
          if ($data->pass1 != $data->pass2 ) {
            Session::flash('alert','Pastikan password yang anda masukan sama.');
            Session::flash('alert-class','alert-danger');
            return redirect(url('/profile'));
          }else {
            $profile->password = Hash::make($data->pass1);
            $profile->status = 1;
          }
        }
        if ($profile->save()) {
          Session::flash('alert','Berhasil mengubah data profile');
          Session::flash('alert-class','alert-success');
        }else {
          Session::flash('alert','Gagal mengubah data profile');
          Session::flash('alert-class','alert-danger');
        }
        return redirect(url('/profile'));
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
