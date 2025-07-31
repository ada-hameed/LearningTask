<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="<?= $this->security->get_csrf_token_name(); ?>" content="<?= $this->security->get_csrf_hash(); ?>">

  <title><?= $title ?? 'AdminLTE 3' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">

  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">

  <!-- RowReorder CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.bootstrap4.min.css">

</head>


<?php if ($this->session->flashdata('toastr_success')): ?>
<script>
  $(document).ready(function () {
    toastr.success("<?= $this->session->flashdata('toastr_success'); ?>");
  });
</script>
<?php endif; ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div id="world-map" style="width: 600px; height: 400px; display:none;"></div>
  <span id="sparkline-1" style="display:none;"></span>

<div class="wrapper">
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
  </div>

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('dashboard') ?>" class="nav-link">Home</a>
      </li> -->
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url('dashboard') ?>" class="brand-link">
      <img src="<?= base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <?php
$default_img = 'assets/dist/img/user2-160x160.jpg';
$img_path = isset($profile->profile_image) && trim($profile->profile_image) !== '' ? $profile->profile_image : $default_img;
$final_img = (strpos($img_path, 'http') === 0) ? $img_path : base_url($img_path);
?>
<div class="image">
  <img 
    src="<?= $final_img ?>"
    onerror="this.onerror=null; this.src='<?= base_url($default_img) ?>';"
    alt="Photo"
    width="30"
    height="30"
    style="object-fit: cover; border-radius: 50%;">
</div>


        <div class="info">
          <a href="#" class="d-block"><?= $profile->name ?></a>
        </div>
      </div>

      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar"><i class="fas fa-search fa-fw"></i></button>
          </div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="<?= base_url('dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>Task Manager</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('dashboard/profile') ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>My Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('login/logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
