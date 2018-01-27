<!DOCTYPE html>
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
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MISS STIKOM Bali - Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" href="{{asset('images/miss.png')}}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('plugins/ionicons/css/ionicons.min.css')}}">
  @yield('ext-css')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/skin-red.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-red fixed">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{url('/')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">MSB2017</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">MSB2017 - PANEL</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{asset('images/miss.jpg')}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{asset('images/miss.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->name}}
                  <small>{{Auth::user()->email}}</small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('/profile')}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->


      <!-- search form (Optional) -->

      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MAIN MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li id="menu-dashboard"><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        @if (Auth::user()->role == 'judge' || Auth::user()->role == 'mentor')
          <li id="menu-assessment"><a href="{{url($prefix.'/assessment')}}"><i class="fa fa-check"></i> <span>Assessment</span></a></li>
        @endif
        @if (Auth::user()->role == 'crew')
          <li id="menu-candidate"><a href="{{url($prefix.'/candidate')}}"><i class="fa fa-users" ></i> <span>Candidate</span></a></li>
          <li id="menu-ticketaccess"><a href="{{url($prefix.'/ticketaccess')}}"><i class="fa fa-ticket" ></i> <span>Ticket Access</span></a></li>
          <!--<li id="menu-ticket"><a href="{{url($prefix.'/ticket')}}"><i class="fa fa-ticket" ></i> <span>Ticket</span></a></li> -->
        @endif
        @if (Auth::user()->role == 'admin')
          <li id="menu-candidate"><a href="{{url($prefix.'/candidate')}}"><i class="fa fa-users" ></i> <span>Candidate</span></a></li>
          <li id="menu-ticket"><a href="{{url($prefix.'/ticket')}}"><i class="fa fa-ticket" ></i> <span>Ticket</span></a></li>
          <li id="menu-ticketaccess"><a href="{{url($prefix.'/ticketaccess')}}"><i class="fa fa-ticket" ></i> <span>Ticket Access</span></a></li>
          <li id="menu-voting"><a href="{{url($prefix.'/voting')}}"><i class="fa fa-thumb-tack" ></i> <span>Voting</span></a></li>
          <li id="menu-assessmentview"><a href="{{url($prefix.'/assessmentviews')}}"><i class="fa fa-eye"></i> <span>Assessment Views</span></a></li>
          <li id="menu-as"><a href="{{url($prefix.'/access')}}"><i class="fa fa-lock"></i> <span>Assessment Access</span></a></li>
          <li id="menu-users"><a href="{{url($prefix.'/users')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>
        @endif
        <li id="menu-profile"><a href="{{url('/profile')}}"><i class="fa fa-user"></i> <span>Profile</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      MISS STIKOM Bali 2017
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="https://himaprodisi.or.id">HIMAPRODI SI - AdminLTE</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/app.min.js')}}"></script>
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
@yield('ext-js')
<script type="text/javascript">
  @yield('js')
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
