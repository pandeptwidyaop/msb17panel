<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Session;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('role','<>','admin')->get();
        return view('user.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $cek = User::where('email',$request->email)->first();
      if ($cek != null) {
        Session::flash('alert','Email sudah digunakan');
        Session::flash('alert-class','alert-danger');
        return redirect(url(Auth::user()->role,'/users'));
      }
      $u = new User;
      $u->email = $request->email;
      $u->name = $request->name;
      $u->password = Hash::make($request->pass);
      $u->role = $request->role;
      if ($u->save()) {
        Session::flash('alert','Berhasil menambah user.');
        Session::flash('alert-class','alert-success');
      }else {
        Session::flash('alert','Berhasil menambah user.');
        Session::flash('alert-class','alert-success');
      }
      return redirect(url(Auth::user()->role.'/users'));
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
