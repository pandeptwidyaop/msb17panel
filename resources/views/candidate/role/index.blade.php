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
      Candidate Role
      <small>Akses Kandidate ke Penilaian</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Candidate Role</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a href="{{url($prefix.'/candidaterole/add')}}" class="btn btn-flat btn-primary">Tambah</a>
    <hr>
    <div class="row">
    @foreach ($data as $key)
      @if (count($key->CandidateRole) != 0)
        <div class="col-md-4">
          <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">{{$key->title}}</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered" width="100%">
                  <tbody>
                    @foreach ($key->CandidateRole as $row)
                      <tr>
                        <td width="1%">{{$row->Candidate->number}}</td>
                        <td>{{$row->Candidate->name}}</td>
                        <td width="5%"><a href="{{url($prefix.'/candidaterole/'.$row->id.'/delete')}}">Hapus</a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      @endif
    @endforeach
  </div>

  </section>
  <!-- /.content -->
</div>
@endsection
@section('js')
  $('#menu-candidaterole').addClass('active');
@endsection
