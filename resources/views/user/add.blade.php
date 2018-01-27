@php
  $prefix = 'admin';
  if (Auth::user()->role == 'judge') {
    $prefix = 'judge';
  }else if (Auth::user()->role == 'crew') {
    $prefix = 'crew';
  }elseif (Auth::user()->role == 'mentor') {
    $prefix = 'mentor';
  }
@endphp
@extends('layouts.template')
@section('ext-css')
  <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
      User
      <small>Add User</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">user</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    @if (Session::has('alert'))
      <div class="alert {{Session::get('alert-class')}} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Informasi !</h4>
        {{Session::get('alert')}}
      </div>
    @endif

    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah User</h3>
        </div>
        <!-- /.box-header -->


        <div class="box-body">
          <div class="row">

            <div class="col-md-4">
              <form class="" action="{{url($prefix.'/users')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" place-holder="Email" class="form-control">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="name" place-holder="Nama" class="form-control">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" name="pass" value="" class="form-control" id="pass">
                  <button type="button" class="btn btn-xs btn-warning btn-flat" onclick="generate()">Generate</button>
                </div>
                <div class="form-group">
                  <select class="form-control" name="role">
                    <option>Pilih</option>
                    <option value="crew">Crew</option>
                    <option value="judge">Judges</option>
                    <option value="mentor">Mentor</option>
                  </select>
                </div>
                <a href="{{url($prefix.'/users')}}" class="btn btn-default btn-flat">Kembali</a>
                <input type="submit" class="btn btn-primary btn-flat pull-right" value="Simpan">
              </form>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
@endsection
@section('ext-js')
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
@endsection
@section('js')
  $('#menu-users').addClass('active');
  function generate(){
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < 10; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    $('#pass').val(text);
  }
@endsection
