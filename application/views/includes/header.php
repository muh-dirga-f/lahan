<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $pageTitle; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/adminlte.min.css">
  <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
  </script>
  <!-- jQuery -->
  <script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition //dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="<?php echo base_url('assets/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
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
        <!-- <li class="nav-item dropdown tasks-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <i class="fa fa-history"></i>
          </a>
          <ul class="dropdown-menu">
            <li class="header"> Last Login : <i class="fa fa-clock-o"></i> <?= empty($last_login) ? "First Time Login" : $last_login; ?></li>
          </ul>
        </li> -->
        <!-- User Account: style can be found in dropdown.less -->
        <li class="nav-item dropdown user user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="user-image" alt="User Image" />
            <span class="hidden-xs"><!--<?php echo $name; ?>--></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">

              <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
              <p>
                <?php echo $name; ?>
                <small><?php echo $role_text; ?></small>
              </p>

            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <!-- <div class="float-left">
                <a href="<?php echo base_url(); ?>profile" class="btn btn-warning btn-flat"><i class="fa fa-user-circle"></i> Profile</a>
              </div> -->
              <div class="//float-right text-center">
                <a href="<?php echo base_url(); ?>logout" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url(); ?>" class="brand-link">
        <img src="<?php echo base_url('assets/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-header">MAIN MENU</li>
            <li class="nav-item">
              <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('data/kecamatan'); ?>" class="nav-link">
                <i class="nav-icon fas fa-map"></i>
                <p>Kecamatan</p>
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('data/perkebunan'); ?>" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>Perkebunan</p>
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('data/pertanian'); ?>" class="nav-link">
                <i class="nav-icon fas fa-seedling"></i>
                <p>Pertanian</p>
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('data/perikanan'); ?>" class="nav-link">
                <i class="nav-icon fas fa-fish"></i>
                <p>Perikanan</p>
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('data/industri'); ?>" class="nav-link">
                <i class="nav-icon fas fa-industry"></i>
                <p>Industri</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>