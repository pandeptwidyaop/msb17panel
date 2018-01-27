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
      Candidate
      <small>Add candidate</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Candidate</li>
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
          <h3 class="box-title">Edit Profil Kandidat</h3>
        </div>
        <!-- /.box-header -->


        <div class="box-body">
          <div class="row">

            <div class="col-md-4">
              <form class="" action="{{url($prefix.'/candidate')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                  <label>NIM</label>
                  <input type="text" name="id" class="form-control">
                </div>
                <div class="form-group">
                  <label>Nomor Undi</label>
                  <input type="number" name="number" class="form-control">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Tempat Lahir</label>
                  <input type="text" name="place_of_birth" class="form-control">
                </div>
                <div class="form-group">
                  <label>Tanggal Lahir</label>
                  <input type="text" name="date_of_birth" class="form-control">
                </div>
                <div class="form-group">
                  <label>Agama</label>
                  <select class="form-control" name="religion">
                    <option value="">Pilih</option>
                    <option value="hindu">Hindu</option>
                    <option value="islam">Islam</option>
                    <option value="kristen">Kristen</option>
                    <option value="budha">Budha</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Nomor Handphone</label>
                  <input type="text" name="phone_number" class="form-control">
                </div>
                <div class="form-group">
                  <label>Kampus</label>
                  <select class="form-control" name="campus">
                    <option value="">Pilih</option>
                    <option value="renon">Kampus I Renon</option>
                    <option value="jimbaran">Kampus II Jimbaran</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Program Studi</label>
                  <select class="form-control" name="">
                    <option value="">Pilih</option>
                    <option value="SI">Sistem Informasi</option>
                    <option value="SK">Sistem Komputer</option>
                    <option value="MI">Management Informatik</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Semester</label>
                  <input type="text" name="semester" class="form-control">
                </div>
                <div class="form-group">
                  <label>Organisasi</label>
                  <input type="text" name="organization" class="form-control">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="address" rows="8" cols="80"></textarea>
                </div>
                <div class="form-group">
                  <label>Pengalaman Organisasi</label>
                  <textarea name="organization_experience" rows="8" cols="80"></textarea>
                </div>
                <div class="form-group">
                  <label>Penghargaan</label>
                  <textarea name="achievements" rows="8" cols="80"></textarea>
                </div>
                <div class="form-group">
                  <label>Minat & Bakat</label>
                  <textarea name="interest_talents" rows="8" cols="80"></textarea>
                </div>
                <div class="form-group">
                  <label>Alasan Mengkuti Ajang</label>
                  <textarea name="reason" rows="8" cols="80"></textarea>
                </div>
                <div class="form-group">
                  <label>Media Sosial</label>
                  <textarea name="social_media" rows="8" cols="80"></textarea>
                </div>
                <div class="form-group">
                  <label>Foto Kandidat</label>
                  <input type="file" name="picture" class="form-control-file">
                </div>
                <a href="{{url($prefix.'/candidate')}}" class="btn btn-default btn-flat">Kembali</a>
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
  $('#menu-candidate').addClass('active');
@endsection
