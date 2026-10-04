<!DOCTYPE html>
<!--
  Template utama GIS Bengkel Kota Bumiayu
  Tema: Industrial Dark / Orange - konsisten dengan halaman login & admin
-->
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Sistem Informasi Geografis persebaran bengkel di Kota Bumiayu. Cari bengkel terdekat, cek kategori servis, dan lihat data terkini secara interaktif.">
  <meta name="theme-color" content="#14161a">
  <title>GIS Bengkel Bumiayu | <?= $judul ?? 'Beranda' ?></title>

  <link rel="icon" type="image/png" href="<?= base_url('AdminLTE') ?>/dist/img/favicon.png">

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

  <!-- Leaflet MarkerCluster (biar rapi kalau titik makin banyak) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
  <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

  <!-- Tema GIS Bengkel (dipakai bersama dengan template admin) -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE/dist/css/mystyle.css') ?>">

  <style>
    /* ====== Tambahan gaya untuk peta & marker kategori ====== */
    #peta-preview {
      height: 460px;
      border-radius: 14px;
      overflow: hidden;
      border: 1px solid rgba(255,255,255,.08);
      box-shadow: 0 10px 30px rgba(0,0,0,.35);
    }

    .map-toolbar {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: .75rem;
      margin-bottom: .85rem;
    }

    .map-filter-chip {
      display: inline-flex;
      align-items: center;
      gap: .4rem;
      padding: .4rem .9rem;
      border-radius: 999px;
      border: 1px solid rgba(255,255,255,.12);
      background: rgba(255,255,255,.03);
      color: var(--text-main, #e8e8e8);
      font-family: 'Rajdhani', sans-serif;
      font-weight: 600;
      font-size: .85rem;
      letter-spacing: .03em;
      cursor: pointer;
      transition: all .15s ease;
      user-select: none;
    }
    .map-filter-chip .dot { width: 10px; height: 10px; border-radius: 50%; display:inline-block; }
    .map-filter-chip[data-active="true"] {
      border-color: var(--accent, #ff7a1a);
      background: rgba(255,122,26,.12);
      color: var(--accent, #ff7a1a);
    }
    .map-filter-chip:hover { border-color: var(--accent, #ff7a1a); }

    .map-search {
      display: flex;
      align-items: center;
      gap: .5rem;
      background: rgba(255,255,255,.03);
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 999px;
      padding: .35rem .9rem;
      min-width: 220px;
    }
    .map-search input {
      background: transparent;
      border: none;
      outline: none;
      color: var(--text-main, #e8e8e8);
      font-family: 'Inter', sans-serif;
      font-size: .85rem;
      width: 100%;
    }
    .map-search i { color: rgba(255,255,255,.4); }

    .map-legend {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      margin-top: .75rem;
      font-family: 'Inter', sans-serif;
      font-size: .8rem;
      color: rgba(255,255,255,.6);
    }
    .map-legend span { display: inline-flex; align-items: center; gap: .4rem; }
    .map-legend .dot { width: 10px; height: 10px; border-radius: 50%; display:inline-block; }

    /* Marker ikon kategori (divIcon) */
    .bengkel-marker {
      width: 34px; height: 34px;
      border-radius: 50% 50% 50% 0;
      transform: rotate(-45deg);
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 3px 10px rgba(0,0,0,.5);
      border: 2px solid rgba(255,255,255,.85);
    }
    .bengkel-marker i { transform: rotate(45deg); color:#fff; font-size: 15px; }
    .bengkel-marker.kat-motor { background: #ff7a1a; }
    .bengkel-marker.kat-mobil { background: #2fa1ff; }
    .bengkel-marker.kat-lain  { background: #9b9b9b; }

    /* Popup */
    .leaflet-popup-content-wrapper {
      background: #1b1e24;
      color: #eaeaea;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,.08);
    }
    .leaflet-popup-tip { background: #1b1e24; }
    .popup-bengkel { font-family: 'Inter', sans-serif; min-width: 220px; }
    .popup-bengkel .foto {
      width: 100%; height: 110px; object-fit: cover;
      border-radius: 8px; margin-bottom: .5rem;
      background: #26292f;
    }
    .popup-bengkel h5 {
      font-family: 'Rajdhani', sans-serif;
      font-weight: 700; font-size: 1rem; margin: 0 0 .25rem;
      color: #fff;
    }
    .popup-bengkel .badge-kat {
      display: inline-block;
      font-size: .68rem; font-weight: 700; letter-spacing: .04em;
      padding: .15rem .55rem; border-radius: 999px; margin-bottom: .4rem;
      text-transform: uppercase;
    }
    .popup-bengkel .badge-kat.kat-motor { background: rgba(255,122,26,.18); color: #ff9c4d; }
    .popup-bengkel .badge-kat.kat-mobil { background: rgba(47,161,255,.18); color: #63b7ff; }
    .popup-bengkel p { margin: 0 0 .3rem; font-size: .82rem; color: rgba(255,255,255,.75); }
    .popup-bengkel .jam { color: var(--accent, #ff7a1a); font-weight: 600; }
    .popup-bengkel a.btn-detail {
      display: inline-block; margin-top: .4rem;
      font-size: .78rem; font-weight: 600; color: #fff;
      background: var(--accent, #ff7a1a); padding: .3rem .75rem;
      border-radius: 8px; text-decoration: none;
    }

    .empty-map-note {
      text-align: center; padding: 2rem 1rem; color: rgba(255,255,255,.5);
      font-family: 'Inter', sans-serif; font-size: .9rem;
    }
  </style>
</head>
<body class="hold-transition sidebar-collapse layout-fixed">

<!-- Preloader -->
<div id="page-preloader"><div class="spinner"></div></div>

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark">
    <div class="container-fluid px-4">
      <a href="<?= base_url() ?>" class="navbar-brand d-flex align-items-center">
        <i class="fas fa-map-marked-alt" style="color:var(--accent); font-size:1.4rem; margin-right:.5rem;"></i>
        <span class="brand-text">GIS <span class="accent">BENGKEL</span> BUMIAYU</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Buka menu navigasi">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?= base_url() ?>" class="nav-link <?= ($active ?? '') === 'beranda' ? 'active' : '' ?>">Beranda</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('peta') ?>" class="nav-link <?= ($active ?? '') === 'peta' ? 'active' : '' ?>">Peta Bengkel</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('tentang') ?>" class="nav-link <?= ($active ?? '') === 'tentang' ? 'active' : '' ?>">Tentang</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kontak') ?>" class="nav-link <?= ($active ?? '') === 'kontak' ? 'active' : '' ?>">Kontak</a>
          </li>
        </ul>
      </div>

      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ms-auto d-flex flex-row align-items-center">
        <li class="nav-item mr-2">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button" title="Buka panel menu" aria-label="Buka panel menu">
            <i class="fas fa-bars"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="btn-login" href="<?= base_url('auth/login') ?>">
            <i class="fas fa-sign-in-alt mr-1"></i> Masuk
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
            <a href="<?= base_url() ?>" class="nav-link <?= ($active ?? '') === 'beranda' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-house"></i>
              <p>Beranda</p>
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
        <span class="eyebrow">Sistem Informasi Geografis</span>
        <h1>Peta Persebaran Bengkel Kota Bumiayu</h1>
        <p>Cari lokasi bengkel terdekat, cek kategori servis, dan lihat data terkini persebaran bengkel di wilayah Bumiayu secara interaktif.</p>
        <div class="mt-3">
          <a href="<?= base_url('peta') ?>" class="btn-login"><i class="fas fa-map-marked-alt mr-1"></i> Lihat Peta</a>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="stat-card">
            <div class="num"><?= $jumlah_bengkel ?? '0' ?></div>
            <div class="lbl"><i class="fas fa-warehouse mr-1"></i>Bengkel Terdaftar</div>
          </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="stat-card">
            <div class="num"><?= $jumlah_kategori ?? '0' ?></div>
            <div class="lbl"><i class="fas fa-tags mr-1"></i>Kategori Servis</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stat-card">
            <div class="num"><?= $jumlah_kecamatan ?? '0' ?></div>
            <div class="lbl"><i class="fas fa-layer-group mr-1"></i>Kecamatan Tercover</div>
          </div>
        </div>
      </div>

      <?php
        /*
         * ============================================================================
         * SUMBER DATA PETA
         * ----------------------------------------------------------------------------
         * $bengkel diharapkan dikirim dari Controller, contoh (Model tbl_bengkel):
         *
         *   $data['bengkel'] = $bengkelModel->select('tbl_bengkel.*, tbl_kategori.marker')
         *                        ->join('tbl_kategori','tbl_kategori.id_kategori = tbl_bengkel.id_kategori','left')
         *                        ->findAll();
         *
         * Kolom yang dipakai di sini mengikuti struktur tabel `tbl_bengkel`:
         *   id_bengkel, id_kategori, kategori, nama_bengkel, alamat,
         *   jam_buka, jam_tutup, coordinat ("lat, lng"), foto
         *
         * Kalau $bengkel belum ada / kosong, peta tetap tampil kosong (tidak error).
         * ============================================================================
         */
        $bengkelData = [];
        foreach (($bengkel ?? []) as $b) {
            // pisahkan string "lat, lng" jadi float
            $coord = array_map('trim', explode(',', $b['coordinat'] ?? ''));
            $lat = isset($coord[0]) ? (float) $coord[0] : null;
            $lng = isset($coord[1]) ? (float) $coord[1] : null;
            if ($lat === null || $lng === null) continue;

            $bengkelData[] = [
                'id'       => $b['id_bengkel'] ?? null,
                'nama'     => $b['nama_bengkel'] ?? '-',
                'alamat'   => $b['alamat'] ?? '-',
                'kategori' => trim($b['kategori'] ?? 'Lainnya'),
                'jam_buka' => isset($b['jam_buka']) ? substr($b['jam_buka'], 0, 5) : null,
                'jam_tutup'=> isset($b['jam_tutup']) ? substr($b['jam_tutup'], 0, 5) : null,
                'foto'     => !empty($b['foto']) ? base_url('uploads/bengkel/' . $b['foto']) : null,
                'lat'      => $lat,
                'lng'      => $lng,
                'detail'   => base_url('bengkel/detail/' . ($b['id_bengkel'] ?? '')),
            ];
        }
      ?>

      <div class="map-toolbar">
        <div class="d-flex flex-wrap" style="gap:.6rem;">
          <div class="map-filter-chip" data-filter="all" data-active="true">
            <i class="fas fa-border-all"></i> Semua
          </div>
          <div class="map-filter-chip" data-filter="motor" data-active="false">
            <span class="dot" style="background:#ff7a1a;"></span> Motor
          </div>
          <div class="map-filter-chip" data-filter="mobil" data-active="false">
            <span class="dot" style="background:#2fa1ff;"></span> Mobil
          </div>
        </div>
        <div class="map-search">
          <i class="fas fa-search"></i>
          <input type="text" id="cariBengkel" placeholder="Cari nama bengkel atau alamat...">
        </div>
      </div>

      <div id="peta-preview" role="region" aria-label="Pratinjau peta persebaran bengkel"></div>

      <div class="map-legend">
        <span><span class="dot" style="background:#ff7a1a;"></span> Bengkel Motor</span>
        <span><span class="dot" style="background:#2fa1ff;"></span> Bengkel Mobil</span>
        <span><i class="fas fa-layer-group mr-1"></i> Titik yang berdekatan otomatis dikelompokkan (cluster)</span>
      </div>

      <script>
        // Data bengkel dikirim dari server (PHP) ke JavaScript
        var dataBengkel = <?= json_encode($bengkelData, JSON_UNESCAPED_SLASHES) ?>;

        var map = L.map('peta-preview', { scrollWheelZoom: false }).setView([-7.2853, 109.1197], 13); // koordinat Bumiayu

        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
          attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
          maxZoom: 19
        }).addTo(map);

        // Ikon marker per kategori
        function buatIkon(kategori) {
          var kat = (kategori || '').toLowerCase();
          var kelas = 'kat-lain';
          var icon  = 'fa-warehouse';
          if (kat.indexOf('motor') !== -1) { kelas = 'kat-motor'; icon = 'fa-motorcycle'; }
          else if (kat.indexOf('mobil') !== -1) { kelas = 'kat-mobil'; icon = 'fa-car'; }

          return L.divIcon({
            className: '',
            html: '<div class="bengkel-marker ' + kelas + '"><i class="fas ' + icon + '"></i></div>',
            iconSize: [34, 34],
            iconAnchor: [17, 34],
            popupAnchor: [0, -32]
          });
        }

        function isiPopup(item) {
          var badgeKelas = (item.kategori || '').toLowerCase().indexOf('motor') !== -1 ? 'kat-motor' : 'kat-mobil';
          var foto = item.foto
            ? '<img class="foto" src="' + item.foto + '" alt="Foto ' + item.nama + '" onerror="this.style.display=\'none\'">'
            : '';
          var jam = (item.jam_buka && item.jam_tutup)
            ? '<p><i class="far fa-clock mr-1"></i>Jam: <span class="jam">' + item.jam_buka + ' - ' + item.jam_tutup + '</span></p>'
            : '';

          return '' +
            '<div class="popup-bengkel">' +
              foto +
              '<span class="badge-kat ' + badgeKelas + '">' + item.kategori + '</span>' +
              '<h5>' + item.nama + '</h5>' +
              '<p><i class="fas fa-map-marker-alt mr-1"></i>' + item.alamat + '</p>' +
              jam +
              '<a class="btn-detail" href="' + item.detail + '">Lihat Detail <i class="fas fa-arrow-right ml-1"></i></a>' +
            '</div>';
        }

        // Cluster group per kategori supaya bisa difilter tanpa reload
        var clusterMotor = L.markerClusterGroup();
        var clusterMobil = L.markerClusterGroup();
        var clusterLain  = L.markerClusterGroup();
        var semuaMarker  = [];

        dataBengkel.forEach(function (item) {
          var marker = L.marker([item.lat, item.lng], { icon: buatIkon(item.kategori) })
                        .bindPopup(isiPopup(item));

          marker.namaCari = (item.nama + ' ' + item.alamat).toLowerCase();

          var kat = (item.kategori || '').toLowerCase();
          if (kat.indexOf('motor') !== -1) { clusterMotor.addLayer(marker); }
          else if (kat.indexOf('mobil') !== -1) { clusterMobil.addLayer(marker); }
          else { clusterLain.addLayer(marker); }

          semuaMarker.push(marker);
        });

        map.addLayer(clusterMotor);
        map.addLayer(clusterMobil);
        map.addLayer(clusterLain);

        // Kalau tidak ada data sama sekali, kasih catatan (bukan peta kosong senyap)
        if (dataBengkel.length === 0) {
          var note = document.createElement('div');
          note.className = 'empty-map-note';
          note.innerHTML = '<i class="fas fa-map-marked-alt mb-2" style="font-size:1.6rem;display:block;"></i>Belum ada data titik bengkel untuk ditampilkan.';
          document.getElementById('peta-preview').appendChild(note);
        } else {
          // fokuskan peta ke area titik-titik yang ada
          var bounds = L.latLngBounds(dataBengkel.map(function (i) { return [i.lat, i.lng]; }));
          map.fitBounds(bounds, { padding: [30, 30] });
        }

        // ==== Filter kategori (chip) ====
        var chips = document.querySelectorAll('.map-filter-chip');
        chips.forEach(function (chip) {
          chip.addEventListener('click', function () {
            chips.forEach(function (c) { c.setAttribute('data-active', 'false'); });
            chip.setAttribute('data-active', 'true');

            var f = chip.getAttribute('data-filter');
            map.removeLayer(clusterMotor);
            map.removeLayer(clusterMobil);
            map.removeLayer(clusterLain);

            if (f === 'all') {
              map.addLayer(clusterMotor); map.addLayer(clusterMobil); map.addLayer(clusterLain);
            } else if (f === 'motor') {
              map.addLayer(clusterMotor);
            } else if (f === 'mobil') {
              map.addLayer(clusterMobil);
            }
          });
        });

        // ==== Pencarian nama / alamat bengkel ====
        document.getElementById('cariBengkel').addEventListener('input', function (e) {
          var q = e.target.value.toLowerCase().trim();
          if (!q) {
            semuaMarker.forEach(function (m) { m.setOpacity(1); });
            return;
          }
          semuaMarker.forEach(function (m) {
            var cocok = m.namaCari.indexOf(q) !== -1;
            m.setOpacity(cocok ? 1 : 0.15);
          });
        });
      </script>
      <?php else: ?>
        <?= view($page) ?>
      <?php endif; ?>

    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  <footer class="main-footer">
    <div class="row w-100 mx-0">
      <div class="col-md-4 mb-2 mb-md-0">
        <strong class="text-main" style="color:var(--text-main)">GIS Bengkel Kota Bumiayu</strong><br>
        Peta persebaran bengkel &amp; layanan servis kendaraan.
      </div>
      <div class="col-md-4 mb-2 mb-md-0">
        <i class="fas fa-map-marker-alt mr-1"></i>Bumiayu, Brebes, Jawa Tengah<br>
        <i class="fas fa-envelope mr-1"></i><a href="mailto:info@gisbengkel.id">info@gisbengkel.id</a>
      </div>
      <div class="col-md-4 text-md-right">
        <span class="d-block d-sm-inline mb-1">Versi 1.0</span><br class="d-none d-sm-block">
        &copy; <?= date('Y') ?> GIS Bengkel Kota Bumiayu. Dibangun dengan CodeIgniter 4.
      </div>
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<button id="back-to-top" title="Kembali ke atas" aria-label="Kembali ke atas">
  <i class="fas fa-arrow-up"></i>
</button>

<!-- REQUIRED SCRIPTS -->
<script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>

<script>
  window.addEventListener('load', function () {
    var pre = document.getElementById('page-preloader');
    if (pre) { pre.classList.add('is-hidden'); }
  });

  var backToTop = document.getElementById('back-to-top');
  window.addEventListener('scroll', function () {
    backToTop.style.display = (window.scrollY > 300) ? 'flex' : 'none';
  });
  backToTop.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
</script>

</body>
</html>