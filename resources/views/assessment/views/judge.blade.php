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
  <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content')
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
      Assessment View
      <small>Team Juri</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{url($prefix.'/assessmentviews')}}"> Assessment Views</a></li>
      <li class="active">Judge</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">


    <div class="row">
      <div class="col-xs-12">
        @foreach ($section as $s)
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$s->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table{{$s->id}}" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th rowspan="2"><center>No</center></th>
                  <th rowspan="2"><center>Nama</center></th>
                  <th colspan="{{count($concept)}}"><center>Aspek Penilaian</center></th>
                  <th rowspan="2"><center>Total</center></th>
                </tr>
                <tr>
                  @foreach ($concept as $c)
                    <td><center>{{$c->title}}</center></td>
                  @endforeach
                </tr>
                </thead>
                <tbody>
                  @foreach ($candidate as $c)
                    @php
                      $total = 0;
                    @endphp
                    <tr>
                      <td>{{$c->number}}</td>
                      <td>{{$c->name}}</td>
                      @foreach ($concept as $co)
                        @php
                          $count = 0;
                        @endphp
                        @foreach ($value as $v)
                          @if ($v->candidate_id == $c->id && $v->Evaluation->Section->id == $s->id && $v->Evaluation->Aspect->Concept->id == $co->id)
                            @php
                              $count += $v->value;
                            @endphp
                          @endif
                        @endforeach
                        <td><center>{{$count}}</center></td>
                        @php
                          $total += $count;
                        @endphp
                      @endforeach
                      <td><center>{{$total}}</center></td>
                    </tr>
                  @endforeach
                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
        @endforeach
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
@endsection
@section('ext-js')
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
@endsection
@section('js')
  $('#menu-assessmentview').addClass('active');
  $(function(){
    @foreach ($section as $s)
      $('#table{{$s->id}}').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true
      });
    @endforeach
  });
@endsection
