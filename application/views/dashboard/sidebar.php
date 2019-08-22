<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | SIKEBO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  <-- folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/all.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sweetalert/dist/sweetalert.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Select 2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- Dropify -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/dropify/dist/css/dropify.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-black sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url('Dashboard') ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini" style="color:#D60606"><b style="color:#000000">S</b><b>KB</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="color:#D60606"><b style="color:#000000">SI</b>KEBO</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url('assets/img/profil/' . $this->session->userdata('path')) ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $this->session->userdata('nama') ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url('assets/img/profil/' . $this->session->userdata('path')) ?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $this->session->userdata('nama') ?>
                    <small>(<?php echo $this->session->userdata('username') ?>)</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo site_url('profil/' . $this->session->userdata('username')) ?>" class="btn btn-info btn-flat">Edit Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo site_url('logout') ?>" class="btn btn-danger btn-flat">Keluar</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url('assets/img/profil/' . $this->session->userdata('path')) ?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $this->session->userdata('username') ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree" id="nav">
          <li class="header">MAIN NAVIGATION</li>
          <li>
            <a href="<?php echo site_url('Dashboard') ?>">
              <i class="fa fa-home"></i> <span>Dashboard</span>
            </a>
          </li>
          <?php if ($this->session->userdata('akses') == "admin") { ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-database"></i>
                <span>Data Master</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('Admin/Komoditas') ?>"><i class="fa fa-circle-o"></i> Komoditas</a></li>
                <li><a href="<?php echo site_url('Admin/Lokasi') ?>"><i class="fa fa-circle-o"></i> Lokasi</a></li>
                <li><a href="<?php echo site_url('Admin/Kebutuhan') ?>"><i class="fa fa-circle-o"></i> Kebutuhan</a></li>
              </ul>
            </li>
            <li>
              <a href="<?php echo site_url('Admin/User') ?>">
                <i class="fa fa-users"></i>
                <span>User</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url('Peneliti/Pengajuan') ?>">
                <i class="fa fa-list"></i>
                <span>Daftar Pengajuan</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url('Admin/Konfirmasi') ?>">
                <i class="fa fa-laptop"></i>
                <span>Konfirmasi Pengajuan</span>
              </a>
            </li>
          <?php } ?>
          <?php if ($this->session->userdata('akses') == "peneliti") { ?>
            <li>
              <a href="<?php echo site_url('Peneliti/Pengajuan') ?>">
                <i class="fa fa-list"></i>
                <span>Daftar Pengajuan</span>
              </a>
            </li>
          <?php } ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>