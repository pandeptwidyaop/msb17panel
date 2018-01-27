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
      Voting View
      <small>Total Voting</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Assessment Views</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Voting</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered" width="100%">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="5%">No</th>
                  <th width="30%">Nama</th>
                  <th width="20%">Total</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $no = 1;
                @endphp
                @foreach ($data as $key)
                  <tr>
                    <td>{{$no}}</td>
                    <td>{{$key->number}}</td>
                    <td>{{$key->name}}</td>
                    <td>{{$key->total}}</td>
                    @php
                      $no++;
                    @endphp
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
  $('#menu-voting').addClass('active');
@endsection
