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
      Evaluation
      <small>Penilaian</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url($prefix.'/assessment')}}">Assessment</a></li>
      <li class="active">Evaluation</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Penilaian</h3>
        </div>
        <!-- /.box-header -->


        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <form class="" action="{{url($prefix.'/assessment/interview')}}" method="post" id="table">
                {{csrf_field()}}
                <div class="form-group">
                  <label>Kandidat</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" required="" name="candidate_id">
                    <option value="">Pilih</option>
                    @foreach ($candidate as $key)
                      <option value="{{$key->id}}">{{$key->number}} - {{$key->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Kemampuan Logika & Berpikir</label>
                  <input type="number" name="kemampuan_logika_berpikir" value="" class="form-control" min="1" max="100" required="">
                </div>
                <div class="form-group">
                  <label>Kemampuan Menjawab Pertanyaan</label>
                  <input type="number" name="kemampuan_menjawab_pertanyaan" value="" class="form-control" min="1" max="100" required="">
                </div>
                <div class="form-group">
                  <label>Komunikatif</label>
                  <input type="number" name="komunikatif" value="" class="form-control" min="1" max="100" required="">
                </div>
                <div class="form-group">
                  <label>Percaya Diri</label>
                  <input type="number" name="percaya_diri" value="" class="form-control" min="1" max="100" required="">
                </div>
                <a href="{{url($prefix.'/assessment/interview')}}" class="btn btn-default btn-flat">Kembali</a>
                <input type="button" class="btn btn-primary btn-flat pull-right" onclick="store()" value="Simpan">
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
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
  <script src="{{asset('plugins/select2/select2.full.min.js')}}"></script>
@endsection
@section('js')
  $('#menu-assessment').addClass('active');
  $(function(){
    $(".select2").select2();
  });
  function store(){
    bootbox.confirm({
      title: "Apakah anda ingin mengirim data nilai ini sekarang ?",
      message: "Anda tidak bisa mengubah atau menghapus nilai ini kembali.",
      buttons: {
          cancel: {
              label: '<i class="fa fa-times"></i> Cancel',
              className: 'btn btn-flat'
          },
          confirm: {
              label: '<i class="fa fa-check"></i> Confirm',
              className: 'btn btn-primary btn-flat'
          }
      },
      callback: function (result) {
          if(result){
            $('#table').submit();
          }
      }
    });
  }
@endsection
