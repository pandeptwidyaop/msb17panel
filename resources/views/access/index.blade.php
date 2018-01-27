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
@section('content')
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
      Assessment Accesses
      <small>Akses Penilaian</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Assessment Access</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">


    <div class="row">
      <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Akses Penilaian</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                  @foreach ($data as $key)
                    <tr>
                      <td>{{$key->Section->title}}</td>
                      <td>{{$key->role}}</td>
                      <td><a href="{{url($prefix.'/access/'.$key->id.'/change/'.$key->access)}}">{{($key->access == 1) ? 'Active' : 'Non Active'}}</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
@endsection
@section('js')
  $('#menu-as').addClass('active');
@endsection
