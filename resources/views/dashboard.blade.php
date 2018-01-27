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
      Dashboard
      <small>Candidate</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="callout callout-success">
      <h4>Total kandidat MISS STIKOM Bali 2017 : <b><u>{{count($data)}}</u></b> mahasiswi</h4>

      <p></p>
    </div>

    <div class="row">
      @foreach ($data as $key)
        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <img src="{{asset('images/'.$key->picture)}}" alt="{{$key->name}}">
            <div class="caption">
              <h4 class="text-center"><b>No : {{$key->number}}</b></h2>
              <h5 class="text-center">{{$key->name}}</h5>
              <p class="text-center"><a href="{{url($prefix.'/candidate/'.$key->id)}}" class="btn btn-flat btn-primary" role="button">Profile</a></p>
            </div>
          </div>
        </div>
      @endforeach
    </div>

  </section>
  <!-- /.content -->
</div>
@endsection
@section('js')
  $('#menu-dashboard').addClass('active');
@endsection
