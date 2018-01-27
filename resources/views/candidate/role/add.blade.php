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


    <div class="row">
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Akses</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="{{url($prefix.'/candidaterole')}}" method="post" role="form">
                    {{ csrf_field() }}
                    <div class="box-body">
                      <div class="form-group">
                        <label for="select">Sesi Penilaian</label>
                        <select name="section_id" id="select" style="width: 100%;">
                          <option class="form-control" value="">Pilih</option>
                          @foreach ($section as $key)
                            <option value="{{$key->id}}">{{$key->title}}</option>
                          @endforeach
                        </select>
                      </div>

                    <table class="table table-bordered" width="100%">
                      <tbody>
                        @foreach ($candidate as $key )
                          <tr>
                            <td width="1%"><input type="checkbox" name="candidate_id[]" value="{{$key->id}}" ></td>
                            <td width="2%">{{$key->number}}</td>
                            <td>{{$key->name}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <hr>
                    <input type="submit" value="Tambah" class="btn btn-primary btn-flat pull-right">
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
@endsection
@section('js')
  $('#menu-candidaterole').addClass('active');
@endsection
