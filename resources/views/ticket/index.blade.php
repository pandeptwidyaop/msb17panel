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
      Ticket
      <small>Ticket List</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Ticket</li>
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
        <div class="col-md-8">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Ticket</h3>
            </div>
            <div class="box-body">
              <a href="#" type="button" class="btn btn-flat btn-primary" onclick="generate();"><i class="fa fa-plus"></i> Generate</a>
              <a href="#" type="button" class="btn btn-flat btn-danger"><i class="fa fa-minus"></i> Drop</a>
              <hr>
              <table class="table table-bordered table-striped" width="100%" id="table">
                <thead>
                  <tr>
                    <th width="5%">Nomor Tiket</th>
                    <th>Kode Tiket</th>
                    <th width="10%">Status Vote</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key)
                    <tr>
                      <td>{{$key->number}}</td>
                      <td>{{$key->unique_number}}</td>
                      <td></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
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

<div class="modal fade" id="modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4> Generate Ticket</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="{{url($prefix.'/ticket')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="usrname"> Prefix</label>
              <input type="text" class="form-control" id="usrname" placeholder="Prefix" name="prefix">
            </div>
            <div class="form-group">
              <label for="psw"> Length</label>
              <input type="number" class="form-control" id="psw" placeholder="Length" name="length">
            </div>
            <div class="form-group">
              <label for="c"> Count</label>
              <input type="number" class="form-control" id="c" placeholder="Count" name="count">
            </div>
            <button type="submit" class="btn btn-primary btn-flat"> Generate</button>
          </form>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
@endsection
@section('ext-js')
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
@endsection
@section('js')
  $('#menu-ticket').addClass('active');
  $(function(){
    $('#table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

  function del(){
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
            $('#delete').attr('action','{{url($prefix.'/ticket')}}');
            $('#delete').submit();
          }
      }
    });

  }

  function generate(){
    $('#modal').modal('show');
  }
@endsection
