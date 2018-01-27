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
      Assessment
      <small>Penilaian</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Assessment</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">


    <div class="row">
      <div class="col-md-4 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
              <h2>Penilaian Wawancara</h2>
            </div>
            <div class="icon">
              <i class="ion ion-edit"></i>
            </div>
            <a href="{{url($prefix.'/assessment/interview')}}" class="small-box-footer">Mulai Penilaian <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>


    <div class="col-md-4 col-xs-6">
      <div class="small-box bg-green">
          <div class="inner">
            <h2>Penilaian Tahap I</h2>
          </div>
          <div class="icon">
            <i class="ion ion-edit"></i>
          </div>
          <a href="{{url($prefix.'/assessment/sectionone')}}" class="small-box-footer">Mulai Penilaian <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-4 col-xs-6">
      <div class="small-box bg-green">
          <div class="inner">
            <h2>Penilaian Minat & Bakat</h2>
          </div>
          <div class="icon">
            <i class="ion ion-edit"></i>
          </div>
          <a href="{{url($prefix.'/assessment/talent')}}" class="small-box-footer">Mulai Penilaian <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-4 col-xs-6">
      <div class="small-box bg-green">
          <div class="inner">
            <h2>Penilaian Tahap II</h2>
          </div>
          <div class="icon">
            <i class="ion ion-edit"></i>
          </div>
          <a href="{{url($prefix.'/assessment/sectiontwo')}}" class="small-box-footer">Mulai Penilaian <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-4 col-xs-6">
      <div class="small-box bg-green">
          <div class="inner">
            <h2>Penilaian Tahap III</h2>
          </div>
          <div class="icon">
            <i class="ion ion-edit"></i>
          </div>
          <a href="{{url($prefix.'/assessment/sectionthree')}}" class="small-box-footer">Mulai Penilaian <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    </div>
  </section>
  <!-- /.content -->
</div>
@endsection
@section('js')
  $('#menu-assessment').addClass('active');
@endsection
