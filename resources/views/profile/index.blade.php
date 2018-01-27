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
      Profile
      <small>User profile</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Profile</li>
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
    @if (Auth::user()->status == 0)
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Informasi !</h4>
        Silakan ganti password anda.
      </div>
    @endif
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Pengaturan Profile</h3>
        </div>
        <!-- /.box-header -->


        <div class="box-body">
          <div class="row">

            <div class="col-md-4">
              <form class="" action="{{url('/profile')}}" method="post">
                <input type="hidden" name="_method" value="put">
                {{csrf_field()}}
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" value="{{$data->email}}" class="form-control" disabled="">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="name" value="{{$data->name}}" class="form-control">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="pass1" value="" class="form-control">
                  <p class="help-block">Kosongkan jika tidak ingin mengubah.</p>
                </div>
                <div class="form-group">
                  <label>Retype Password</label>
                  <input type="password" name="pass2" value="" class="form-control">
                  <p class="help-block">Kosongkan jika tidak ingin mengubah.</p>
                </div>
                <a href="{{url('home')}}" class="btn btn-default btn-flat">Kembali</a>
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
  $('#menu-profile').addClass('active');
@endsection
