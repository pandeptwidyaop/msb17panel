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
@section('ext-css')
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@extends('layouts.template')
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
      <li class="active">Tahap I</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        @if (Session::has('alert'))
          <div class="alert {{Session::get('alert-class')}} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Informasi !</h4>
            {{Session::get('alert')}}
          </div>
        @endif
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Penilaian Tahap I</h3>
          </div>
          <div class="box-body">
            <a href="{{url($prefix.'/assessment/sectionone/create')}}" type="button" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah</a>
            <hr>
            <table class="table table-bordered table-striped" width="100%" id="table">
              <thead>
                <tr>
                  <th rowspan="3" class="text-center" width="1%"><center>No</center></th>
                  <th rowspan="3" class="text-center" width="20%"><center>Nama</center></th>
                  <th colspan="10" rowspan="0" class="text-center"><center>Aspek Penilaian</center></th>
                  <th rowspan="3" class="text-center" width="5%"><center>Total</th>
                </tr>
                <tr>
                  <td width="15%" colspan="2"><center>Brain (30%)</center></td>
                  <td width="37%" colspan="5"><center>Beauty (35%)</center></td>
                  <td width="22.2%" colspan="3"><center>Behaviour (35%)</center></td>
                </tr>
                <tr>
                  <td width="7.4%"><center>Wawancara (50%)</center></td>
                  <td width="7.4%"><center>Kemampuan Menjawab Pernyataan (50%)</center></td>
                  <td width="7.4%"><center>Fashion Show  (20%)</center></td>
                  <td width="7.4%"><center>Catwalk (20%)</center></td>
                  <td width="7.4%"><center>Body Languange (20%)</center></td>
                  <td width="7.4%"><center>Ekspresi (20%)</center></td>
                  <td width="7.4%"><center>Kencantikan (20%)</center></td>
                  <td width="7.4%"><center>Public Speaking (40%)</center></td>
                  <td width="7.4%"><center>Sikap (30%)</center></td>
                  <td width="7.4%"><center>Percaya Diri (30%)</center></td>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $row)
                  <tr>
                    <td><center>{{$row->number}}</center></td>
                    <td>{{$row->name}}</td>
                    <td><center>{{$row->wawancara}}</center></td>
                    <td><center>{{$row->kemampuan_menjawab_pertanyaan}}</center></td>
                    <td><center>{{$row->fashion_show}}</center></td>
                    <td><center>{{$row->catwalk}}</center></td>
                    <td><center>{{$row->body_language}}</center></td>
                    <td><center>{{$row->ekspresi}}</center></td>
                    <td><center>{{$row->kecantikan}}</center></td>
                    <td><center>{{$row->public_speaking}}</center></td>
                    <td><center>{{$row->sikap}}</center></td>
                    <td><center>{{$row->percaya_diri}}</center></td>
                    <td><center>{{$row->total}}</center></td>
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

<form class="hidden" action="" method="post" id="delete">
  <input type="hidden" name="_method" value="delete">
  {{ csrf_field() }}
</form>
@endsection
@section('ext-js')
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
@endsection
@section('js')
  $('#menu-assessment').addClass('active');
  $(function(){
    $('#table').DataTable({
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });
  });

  function del(id,nim){
    bootbox.confirm({
      title: "Ingin menghapus data ini ?",
      message: "Apakah anda memang benar ingin menghapus data penilaian ini ?",
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
            $('#delete').attr('action','{{url($prefix.'/assessment')}}/'+id+'/evaluation/'+nim+'/delete');
            $('#delete').submit();
          }
      }
    });

  }
@endsection
