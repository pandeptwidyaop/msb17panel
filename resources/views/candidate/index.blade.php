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
      <small>All Candidate</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li>Candidate</li>
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
    <div class="callout callout-success">
      <h4>Total kandidat MISS STIKOM Bali 2017 : <b><u>{{count($data)}}</u></b> mahasiswi</h4>

      <p></p>
    </div>

    <div class="btn-group">
      <a href="{{url($prefix.'/candidate/create')}}" class="btn btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah</a>
    </div>
    <hr>
    <div class="row">
      @foreach ($data as $key)
        <div class="col-sm-3 col-md-3">
          <div class="thumbnail">
            <img src="{{asset('images/'.$key->picture)}}" alt="{{$key->name}}">
            <div class="caption">
              <h4 class="text-center"><b>No : {{$key->number}}</b></h2>
              <h5 class="text-center">{{$key->name}}</h5>
              <p class="text-center">
                <a href="{{url($prefix.'/candidate/'.$key->id)}}" class="btn btn-flat btn-primary" role="button">Profile</a>
                <a href="{{url($prefix.'/candidate/'.$key->id).'/edit'}}" class="btn btn-flat btn-primary" role="button">Edit</a>
                <a href="#" class="btn btn-flat btn-primary" role="button" onclick="del({{$key->id}})">Hapus</a>
              </p>
            </div>
          </div>
        </div>
      @endforeach
    </div>

  </section>
  <!-- /.content -->
</div>
<form class="hidden" action="" method="post" id="delete">
  <input type="hidden" name="_method" value="DELETE">
  {{ csrf_field() }}
</form>
@endsection
@section('ext-js')
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}" charset="utf-8"></script>
@endsection
@section('js')
  $('#menu-candidate').addClass('active');

  function del(id){
    bootbox.confirm({
     title: "Ingin menghapus data ini ?",
     message: "Apakah anda memang benar ingin menghapus data kandidat ini ?",
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
           $('#delete').attr('action','{{url($prefix.'/candidate')}}/'+id);
           $('#delete').submit();
         }
     }
  })
}
@endsection
