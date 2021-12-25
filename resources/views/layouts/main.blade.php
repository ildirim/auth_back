<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>One Touch</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/admin/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/admin/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('js/admin/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('js/admin/adminlte.min.js') }}"></script>
  <script src="{{ asset('js/admin/toastr.min.js') }}"></script>
  <script src="{{ asset('js/jquery.mask.js') }}"></script>
  <script src="{{ asset('js/admin/custom.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('home') }}" class="brand-link">
        <img src="wp-content/uploads/2021/07/onetouch.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">.</span>
      </a>
        

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       
        <div class="info">
          <a href="javascript:void(0)" class="d-block">{{ auth()->user()->full_name }}</a>
        </div>
      </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ route('myProfile') }}" class="nav-link">
                <i class="nav-icon far fa-user-circle"></i>
                <p>
                  My profile
                </p>
              </a>
            </li>
           @if(auth()->user()->is_admin == 1)
            <li class="nav-item">
              <a href="{{ route('package') }}" class="nav-link">
                <i class="nav-icon fas fa-cube"></i>
                <p>
                  Package
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('user') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Users
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('card') }}" class="nav-link">
                <i class="nav-icon far fa-credit-card"></i>
                <p>
                  Cards
                </p>
              </a>
            </li>
            @endif
           @if(auth()->user()->is_admin == 0)
            <li class="nav-item">
              <a href="{{ route('sharedLink') }}" class="nav-link">
                <i class="nav-icon fas fa-link"></i>
                <p>
                  Shared links
                </p>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <form id="logout-form" method="post" action="{{ route('logout') }}">
                @csrf
                <a href="javascript:$('#logout-form').submit()" class="nav-link" style="background-color: #343a40;">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </form>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    @yield('main')
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <form method="post" id="form-confirm-delete">
              @csrf
              @method('PUT')
              <div class="modal-content">
                  <div class="modal-body">
                      Are you sure you want to delete it?
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                      <button class="btn btn-danger btn-ok">Yes</button>
                  </div>
              </div>
          </form>
      </div>
  </div>
  </div>
</body>