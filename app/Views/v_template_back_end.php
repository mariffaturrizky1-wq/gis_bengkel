<!DOCTYPE html>
<!--
  Template Admin — GIS Bengkel
  Tema: Industrial Dark / Orange - konsisten dengan halaman publik & login
-->
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Panel admin Sistem Informasi Geografis Bengkel">
  <title>GIS Bengkel | <?= $judul ?></title>

  <link rel="icon" type="image/png" href="<?= base_url('AdminLTE') ?>/dist/img/favicon.png">

  <!-- Google Font: Rajdhani (display) + Inter (body), selaras dgn tampilan publik -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">

  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <!-- Tema GIS Bengkel (di-load PALING AKHIR agar override AdminLTE default) -->
<link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/mystyle.css') ?>">

  <!-- jQuery -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/select2/js/select2.full.min.js"></script>
  <!-- bootstrap color picker -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('AdminLTE') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- AdminLTE App -->
  <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">

<!-- Preloader singkat, biar transisi antar halaman terasa lebih "engineered" -->
<div id="page-preloader"><div class="spinner"></div></div>

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url() ?>" class="nav-link">Beranda Situs</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('kontak') ?>" class="nav-link">Kontak</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <span class="nav-link d-none d-md-inline-block text-muted">
          <i class="fas fa-clock mr-1"></i><?= date('d M Y') ?>
        </span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
          <i class="fas fa-sign-out-alt"></i> Log Out
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Admin')?>" class="brand-link">
      <i class="fas fa-oil-can" style="color:var(--accent); font-size:1.3rem; margin-right:.5rem;"></i>
      <span class="brand-text font-weight-light">Gis <span style="color:var(--accent)">Bengkel</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('foto/'.  session()->get('foto')) ?>" class="img-circle elevation-2" alt="user_image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= session()->get('nama_user') ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Cari menu" aria-label="Cari menu">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="<?= base_url('Admin') ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('Wilayah') ?>" class="nav-link <?= $menu == 'wilayah' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>Wilayah</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('Kategori') ?>" class="nav-link <?= $menu == 'kategori' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tags"></i>
              <p>Kategori</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('Bengkel') ?>" class="nav-link <?= $menu == 'bengkel' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tools"></i>
              <p>Bengkel</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('User') ?>" class="nav-link <?= $menu == 'user' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>User</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('Admin/Setting') ?>" class="nav-link <?= $menu == 'setting' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Setting</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $judul ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('Admin') ?>"><i class="fas fa-tachometer-alt mr-1"></i>Dashboard</a></li>
              <li class="breadcrumb-item active"><?= $judul ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->

        <?php if (session()->getFlashdata('success')) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle mr-1"></i><?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('message')) : ?>
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle mr-1"></i><?= session()->getFlashdata('message') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
          </div>
        <?php endif; ?>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.isi konten -->
          <?php
          if ($page) {
            echo view($page);
          }
          ?>
          <!-- /end isi konten -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Versi 1.0
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url() ?>">GIS Bengkel</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<button id="back-to-top" title="Kembali ke atas" aria-label="Kembali ke atas">
  <i class="fas fa-arrow-up"></i>
</button>

<!-- REQUIRED SCRIPTS -->
<script>
  // Sembunyikan preloader setelah halaman siap
  window.addEventListener('load', function () {
    var pre = document.getElementById('page-preloader');
    if (pre) { pre.classList.add('is-hidden'); }
  });

  // Tombol kembali ke atas
  var backToTop = document.getElementById('back-to-top');
  window.addEventListener('scroll', function () {
    backToTop.style.display = (window.scrollY > 300) ? 'flex' : 'none';
  });
  backToTop.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // Auto-tutup alert flash setelah beberapa detik
  setTimeout(function () {
    document.querySelectorAll('.content-header .alert').forEach(function (el) {
      if (window.jQuery) { jQuery(el).alert('close'); }
    });
  }, 5000);
</script>

</body>
</html>