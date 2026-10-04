<!DOCTYPE html>
<!--
  Template utama GIS Bengkel Kota Bumiayu
  Tema: Industrial Dark / Orange - konsisten dengan halaman login
-->
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Sistem Informasi Geografis persebaran bengkel di Kota Bumiayu">
  <title>GIS Bengkel Bumiayu | <?= $judul ?? 'Beranda' ?></title>

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">

  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <style>
    :root{
      --bg-base: #14161a;
      --bg-panel: #1c1f24;
      --bg-panel-2: #23272e;
      --steel: #3a3f47;
      --accent: #ff6a1f;
      --accent-dim: #b8501a;
      --text-main: #e9eaec;
      --text-mute: #9aa0a8;
      --hazard: #ffb020;
    }

    body.hold-transition{
      background: var(--bg-base);
      font-family: 'Inter', sans-serif;
      color: var(--text-main);
    }

    h1,h2,h3,h4,h5,.brand-text,.nav-link{
      font-family: 'Rajdhani', sans-serif;
    }

    /* ---- Navbar ---- */
    .main-header.navbar{
      background: var(--bg-panel);
      border-bottom: 3px solid var(--accent);
    }
    .main-header .navbar-brand .brand-text{
      color: var(--text-main);
      font-weight: 700;
      letter-spacing: .5px;
      font-size: 1.2rem;
    }
    .main-header .navbar-brand .brand-text .accent{ color: var(--accent); }
    .main-header .nav-link{ color: var(--text-main) !important; font-weight: 600; }
    .main-header .nav-link:hover{ color: var(--accent) !important; }
    .btn-login{
      background: var(--accent);
      color: #14161a;
      font-weight: 700;
      padding: .4rem 1.1rem;
      border-radius: 4px;
      transition: background .15s ease;
    }
    .btn-login:hover{ background: var(--hazard); color: #14161a; }

    /* ---- Sidebar ---- */
    .main-sidebar{
      background: var(--bg-panel) !important;
      border-right: 1px solid var(--steel);
    }
    .brand-link{ border-bottom: 1px solid var(--steel) !important; }
    .nav-sidebar .nav-link{ color: var(--text-mute); }
    .nav-sidebar .nav-link.active, .nav-sidebar .nav-link:hover{
      background: var(--bg-panel-2);
      color: var(--accent) !important;
      border-left: 3px solid var(--accent);
    }
    .nav-sidebar .nav-icon{ color: inherit; }
    .user-panel .info a{ color: var(--text-main); font-weight: 600; }

    /* ---- Hero (landing) ---- */
    .hero-strip{
      background: linear-gradient(120deg, var(--bg-panel) 0%, var(--bg-panel-2) 100%);
      border: 1px solid var(--steel);
      border-left: 4px solid var(--accent);
      border-radius: 6px;
      padding: 2rem;
      margin-bottom: 1.5rem;
    }
    .hero-strip h1{ font-size: 1.9rem; font-weight: 700; margin-bottom: .3rem; }
    .hero-strip p{ color: var(--text-mute); max-width: 42rem; }
    .stat-card{
      background: var(--bg-panel-2);
      border: 1px solid var(--steel);
      border-radius: 6px;
      padding: 1rem 1.25rem;
      text-align: center;
    }
    .stat-card .num{ font-family: 'Rajdhani', sans-serif; font-size: 2rem; font-weight: 700; color: var(--accent); }
    .stat-card .lbl{ color: var(--text-mute); font-size: .8rem; text-transform: uppercase; letter-spacing: .5px; }

    #peta-preview{ height: 320px; border-radius: 6px; border: 1px solid var(--steel); }

    /* ---- Content wrapper & footer ---- */
    .content-wrapper{ background: var(--bg-base); }
    .card{ background: var(--bg-panel); border: 1px solid var(--steel); color: var(--text-main); }
    .main-footer{
      background: var(--bg-panel);
      border-top: 1px solid var(--steel);
      color: var(--text-mute);
    }
    .main-footer a{ color: var(--accent); }
  </style>
</head>
<body class="hold-transition sidebar-collapse layout-top-nav layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark">
    <div class="container-fluid px-4">
      <a href="<?= base_url() ?>" class="navbar-brand d-flex align-items-center">
        <i class="fas fa-map-marked-alt accent" style="color:var(--accent); font-size:1.4rem; margin-right:.5rem;"></i>
        <span class="brand-text">GIS <span class="accent">BENGKEL</span> BUMIAYU</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item"><a href="<?= base_url() ?>" class="nav-link">Beranda</a></li>
          <li class="nav-item"><a href="<?= base_url('peta') ?>" class="nav-link">Peta Bengkel</a></li>
          <li class="nav-item"><a href="<?= base_url('tentang') ?>" class="nav-link">Tentang</a></li>
          <li class="nav-item"><a href="<?= base_url('kontak') ?>" class="nav-link">Kontak</a></li>
        </ul>
      </div>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ms-auto">
        <li class="nav-item">
          <a class="btn-login" href="<?= base_url('auth/login') ?>">
            <i class="fas fa-sign-in-alt me-1"></i> Masuk
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url() ?>" class="brand-link">
      <i class="fas fa-oil-can" style="color:var(--accent); font-size:1.3rem; margin-right:.5rem;"></i>
      <span class="brand-text font-weight-light">GIS Bengkel</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('AdminLTE') ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="Foto pengguna">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $nama_user ?? 'Pengunjung' ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= base_url() ?>" class="nav-link <?= ($active ?? '') === 'dashboard' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('bengkel') ?>" class="nav-link <?= ($active ?? '') === 'bengkel' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>Data Bengkel</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('peta') ?>" class="nav-link <?= ($active ?? '') === 'peta' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-map-marked-alt"></i>
              <p>Peta Sebaran</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kategori') ?>" class="nav-link <?= ($active ?? '') === 'kategori' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tags"></i>
              <p>Kategori Servis</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('laporan') ?>" class="nav-link <?= ($active ?? '') === 'laporan' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Laporan</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content p-4">

      <?php if (($page ?? null) === null): ?>
      <!-- Konten default landing, tampil kalau $page belum di-set -->
      <div class="hero-strip">
        <h1>Peta Persebaran Bengkel Kota Bumiayu</h1>
        <p>Cari lokasi bengkel terdekat, cek kategori servis, dan lihat data terkini persebaran bengkel di wilayah Bumiayu secara interaktif.</p>
      </div>

      <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="stat-card">
            <div class="num"><?= $jumlah_bengkel ?? '0' ?></div>
            <div class="lbl">Bengkel Terdaftar</div>
          </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="stat-card">
            <div class="num"><?= $jumlah_kategori ?? '0' ?></div>
            <div class="lbl">Kategori Servis</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stat-card">
            <div class="num"><?= $jumlah_kecamatan ?? '0' ?></div>
            <div class="lbl">Kecamatan Tercover</div>
          </div>
        </div>
      </div>

      <div id="peta-preview"></div>
      <script>
        var map = L.map('peta-preview').setView([-7.2853, 109.1197], 13); // koordinat Bumiayu
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
      </script>
      <?php else: ?>
        <?= view($page) ?>
      <?php endif; ?>

    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Versi 1.0
    </div>
    <strong>&copy; <?= date('Y') ?> GIS Bengkel Kota Bumiayu.</strong> Dibangun dengan CodeIgniter 4.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>

</body>
</html>