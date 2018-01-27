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
      Candidate
      <small>Detail</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Candidate</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><p class="text-center">Nomor Urut : <b>{{$data->number}}</b></p></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="#" class="thumbnail">
                <img src="{{asset('images/'.$data->picture)}}" alt="{{$data->name}}">
              </a>
              <table class="table table-responsive table-bordered table-striped">
                <tr>
                  <td>Nomor Undi</td>
                  <td>{{$data->number}}</td>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>{{$data->name}}</td>
                </tr>
                <tr>
                  <td>TTL</td>
                  <td>{{$data->place_of_birth}}, {{date('d F Y', strtotime($data->date_of_birth))}}</td>
                </tr>
                <tr>
                  <td>Agama</td>
                  <td>{{ucfirst($data->religion)}}</td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>{{$data->address}}</td>
                </tr>
                <tr>
                  <td>Handphone</td>
                  <td>{{$data->phone_number}}</td>
                </tr>
                <tr>
                  <td>Asal Kampus</td>
                  <td>{{ucfirst($data->campus)}}</td>
                </tr>
                <tr>
                  <td>Program Studi</td>
                  <td>{{$data->study_program}}</td>
                </tr>
                <tr>
                  <td>Semester</td>
                  <td>{{$data->semester}}</td>
                </tr>
                <tr>
                  <td>Ormawa</td>
                  <td>{{$data->organization}}</td>
                </tr>
                <tr>
                  <td>Pengalam Organisasi</td>
                  <td>{{$data->organization_experience}}</td>
                </tr>
                <tr>
                  <td>Pernghargaan</td>
                  <td>{{$data->achievements}}</td>
                </tr>
                <tr>
                  <td>Minat & Bakat</td>
                  <td>{{$data->interest_talents}}</td>
                </tr>
                <tr>
                  <td>Alasan Mengikutin Ajang</td>
                  <td>{{$data->reason}}</td>
                </tr>
                <tr>
                  <td>Media Sosial</td>
                  <td>{{$data->social_media}}</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
          </div>


      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
@endsection
@section('js')
  @php
    if (Auth::user()->role == 'judge' || Auth::user()->role == 'mentor') {
      $print = "$('#menu-dashboard').addClass('active')";
    }else {
        $print = "$('#menu-candidate').addClass('active')";
    }
  @endphp
  {!!$print!!}
@endsection
