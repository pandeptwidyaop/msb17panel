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
          <h3 class="box-title">Edit Penilaian</h3>
        </div>
        <!-- /.box-header -->


        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <form class="" action="{{url($prefix.'/assessment/'.$id.'/evaluation/'.$value[0]->candidate_id.'/edit')}}" method="post">
                <input type="hidden" name="_method" value="PUT">
                {{csrf_field()}}
                <div class="form-group">
                  <label>Kandidat</label>
                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" required="" name="candidate_id" disabled="">
                    <option value="{{$value[0]->candidate_id}}">{{$value[0]->Candidate->number}} - {{$value[0]->Candidate->name}}</option>
                  </select>
                </div>
                @foreach ($value as $list)
                  <div class="form-group">
                    <label>{{$list->Evaluation->Aspect->title}}</label>
                    <input type="number" name="value[{{$list->id}}]" value="{{$list->value}}" class="form-control" min="1" max="100" required="">
                  </div>
                @endforeach
                <a href="{{url($prefix.'/assessment/'.$id.'/evaluation')}}" class="btn btn-default btn-flat">Kembali</a>
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
  $('#menu-assessment').addClass('active');
  $(function(){
    $(".select2").select2();
  });
@endsection
