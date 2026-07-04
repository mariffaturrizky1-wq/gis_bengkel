<?php 
// File: app/Views/v_dashboard.php

// Ambil koneksi database langsung di dalam view agar auto-env tanpa crash controller
$db = \Config\Database::connect();

// Hitung total data langsung (Sesuaikan nama tabel jika berbeda)
$total_wilayah  = $db->table('tbl_wilayah')->countAllResults(); 
$total_bengkel  = $db->table('tbl_bengkel')->countAllResults(); 
$total_kategori = $db->table('tbl_kategori')->countAllResults(); 
$total_users    = $db->table('tbl_user')->countAllResults(); 

// Distribusi bengkel per kategori (untuk chart). Sesuaikan nama kolom relasi bila berbeda.
$kategori_chart = [];
try {
    $kategori_chart = $db->table('tbl_bengkel b')
        ->select('k.kategori as label, COUNT(b.id_bengkel) as jumlah')
        ->join('tbl_kategori k', 'k.id_kategori = b.id_kategori', 'left')
        ->groupBy('k.kategori')
        ->orderBy('jumlah', 'DESC')
        ->get()->getResultArray();
} catch (\Throwable $e) {
    $kategori_chart = [];
}

// Distribusi bengkel per wilayah (untuk chart)
$wilayah_chart = [];
try {
    $wilayah_chart = $db->table('tbl_bengkel b')
        ->select('w.nama_wilayah as label, COUNT(b.id_bengkel) as jumlah')
        ->join('tbl_wilayah w', 'w.id_wilayah = b.id_wilayah', 'left')
        ->groupBy('w.nama_wilayah')
        ->orderBy('jumlah', 'DESC')
        ->get()->getResultArray();
} catch (\Throwable $e) {
    $wilayah_chart = [];
}
?>

<style>
/* ==================== FIX: paksa wrapper induk full width ====================
   Banyak template admin (AdminLTE/Bootstrap based) membungkus konten dengan
   class .container / .container-fluid / .content yang punya max-width tetap.
   Baris di bawah ini menimpa itu supaya dashboard menempel penuh ke kanan,
   tanpa perlu mengubah file layout/header. Aman karena hanya berlaku pada
   ancestor langsung dari .bk-ui (lewat cascade), tidak mengubah komponen lain. */
.content-wrapper .container,
.content-wrapper .container-fluid,
.content .container,
.content .container-fluid,
main .container,
main .container-fluid{
    max-width:100% !important;
    width:100% !important;
    padding-left:0 !important;
    padding-right:0 !important;
}

/* ==================== Bengkel UI Theme (shared tokens) ==================== */
.bk-ui{
    --bk-primary:#0f766e;
    --bk-primary-dark:#0b4f4a;
    --bk-primary-soft:#e6f4f2;
    --bk-accent:#f59e0b;
    --bk-accent-2:#ea580c;
    --bk-ink:#1e293b;
    --bk-ink-soft:#64748b;
    --bk-bg:#f1f5f9;
    --bk-surface:#ffffff;
    --bk-border:#e2e8f0;
    --bk-dark:#0f172a;
    font-family:'Inter',-apple-system,BlinkMacSystemFont,sans-serif;
    color:var(--bk-ink);
    width:100%;
    max-width:100%;
    box-sizing:border-box;
}
.bk-ui *{ box-sizing:border-box; }
.bk-heading{ font-family:'Space Grotesk','Inter',sans-serif; font-weight:700; letter-spacing:-0.01em; }
.bk-mono{ font-family:'JetBrains Mono',monospace; }

/* Tape-measure style divider used as a signature motif */
.bk-tick-rule{
    height:6px;
    width:100%;
    background-image:repeating-linear-gradient(90deg, var(--bk-accent) 0 2px, transparent 2px 10px);
    opacity:.55;
    border-radius:3px;
    margin:.35rem 0 1rem 0;
}

/* Page intro banner */
.bk-banner{
    background:linear-gradient(120deg, var(--bk-dark) 0%, var(--bk-primary-dark) 100%);
    border-radius:14px;
    padding:26px 30px;
    color:#fff;
    margin-bottom:20px;
    position:relative;
    overflow:hidden;
    width:100%;
}
.bk-banner::after{
    content:"";
    position:absolute; right:-30px; top:-30px; width:220px; height:220px;
    background:radial-gradient(circle, rgba(245,158,11,.25), transparent 70%);
}
.bk-banner::before{
    content:"";
    position:absolute; left:20%; bottom:-60px; width:180px; height:180px;
    background:radial-gradient(circle, rgba(14,165,233,.18), transparent 70%);
}
.bk-banner h1{ font-size:1.6rem; margin:0 0 4px 0; color:#fff; }
.bk-banner p{ margin:0; color:#cbd5e1; font-size:.92rem; position:relative; z-index:1; }
.bk-banner .bk-eyebrow{
    display:inline-flex; align-items:center; gap:6px;
    font-size:.7rem; text-transform:uppercase; letter-spacing:.12em;
    color:var(--bk-accent); font-weight:700; margin-bottom:8px;
    position:relative; z-index:1;
}

/* Stat cards */
.bk-stat-row{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));
    gap:16px;
    margin-bottom:20px;
    width:100%;
}
.bk-stat-card{
    background:var(--bk-surface);
    border:1px solid var(--bk-border);
    border-radius:14px;
    padding:18px 18px 16px;
    display:flex; align-items:flex-start; gap:14px;
    transition:transform .18s ease, box-shadow .18s ease;
    position:relative;
    overflow:hidden;
}
.bk-stat-card::before{
    content:"";
    position:absolute; inset:0 0 auto 0; height:3px;
    background:linear-gradient(90deg, var(--bk-primary), var(--bk-accent));
    opacity:0; transition:opacity .2s ease;
}
.bk-stat-card:hover{ transform:translateY(-3px); box-shadow:0 10px 24px -12px rgba(15,23,42,.25); }
.bk-stat-card:hover::before{ opacity:1; }
.bk-stat-icon{
    width:48px; height:48px; border-radius:12px;
    display:flex; align-items:center; justify-content:center;
    font-size:1.2rem; color:#fff; flex:none;
    transition:transform .35s ease;
    box-shadow:0 6px 14px -6px rgba(0,0,0,.35);
}
.bk-stat-card:hover .bk-stat-icon{ transform:rotate(12deg) scale(1.05); }
.bk-stat-icon.c-wilayah{ background:#0ea5e9; }
.bk-stat-icon.c-bengkel{ background:var(--bk-primary); }
.bk-stat-icon.c-kategori{ background:var(--bk-accent); }
.bk-stat-icon.c-users{ background:var(--bk-accent-2); }
.bk-stat-label{ font-size:.78rem; color:var(--bk-ink-soft); font-weight:600; text-transform:uppercase; letter-spacing:.04em; margin-bottom:2px; }
.bk-stat-value{ font-family:'JetBrains Mono',monospace; font-size:1.75rem; font-weight:700; line-height:1.1; color:var(--bk-ink); }
.bk-stat-value small{ font-family:'Inter',sans-serif; font-size:.7rem; font-weight:600; color:var(--bk-ink-soft); margin-left:4px; }

/* Section card wrapper */
.bk-card{
    background:var(--bk-surface);
    border:1px solid var(--bk-border);
    border-radius:14px;
    padding:20px 22px;
    margin-bottom:20px;
    width:100%;
}
.bk-card-title{ display:flex; align-items:center; gap:8px; font-size:1.05rem; margin:0; }
.bk-card-title i{ color:var(--bk-primary); }

/* Quick links - redesign biar lebih 'keren' */
.bk-quick-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));
    gap:14px;
    width:100%;
}
.bk-quick-link{
    display:flex; align-items:center; gap:12px;
    padding:16px 16px; border-radius:14px;
    background:var(--bk-primary-soft); color:var(--bk-primary-dark);
    text-decoration:none; border:1px solid transparent;
    position:relative; overflow:hidden;
    transition:all .2s ease;
}
.bk-quick-link .bk-quick-icon{
    width:42px; height:42px; border-radius:10px;
    background:#fff; color:var(--bk-primary);
    display:flex; align-items:center; justify-content:center;
    font-size:1.05rem; flex:none;
    box-shadow:0 4px 10px -4px rgba(15,23,42,.25);
    transition:all .25s ease;
}
.bk-quick-link span{ font-weight:600; font-size:.9rem; }
.bk-quick-link::after{
    content:"\f105"; /* fa-chevron-right */
    font-family:"Font Awesome 5 Free"; font-weight:900;
    position:absolute; right:14px; opacity:0; transform:translateX(-6px);
    transition:all .2s ease; font-size:.85rem;
}
.bk-quick-link:hover{
    background:linear-gradient(120deg, var(--bk-primary), var(--bk-primary-dark));
    color:#fff; text-decoration:none;
    box-shadow:0 10px 22px -10px rgba(15,118,110,.55);
    transform:translateY(-2px);
}
.bk-quick-link:hover .bk-quick-icon{ background:rgba(255,255,255,.18); color:#fff; }
.bk-quick-link:hover::after{ opacity:1; transform:translateX(0); }

/* Charts row */
.bk-chart-row{ display:grid; grid-template-columns:repeat(auto-fit, minmax(300px, 1fr)); gap:20px; width:100%; }
.bk-chart-box{
    min-width:0; /* fix: cegah canvas overflow di flex/grid */
    position:relative;
    height:300px; /* FIX BUG: tinggi tetap supaya Chart.js tidak resize-loop/melar */
}
.bk-chart-box canvas{ max-height:100%; }
.bk-empty-note{ color:var(--bk-ink-soft); font-size:.85rem; font-style:italic; }

/* Map/visualization panel */
.bk-viz-header{
    background:var(--bk-accent);
    border-radius:14px 14px 0 0;
    padding:14px 20px;
    display:flex; align-items:center; justify-content:space-between;
    width:100%;
}
.bk-viz-header h3{ margin:0; font-size:.95rem; color:var(--bk-dark); }
.bk-viz-wrap{
    background:var(--bk-dark);
    border-radius:0 0 14px 14px;
    overflow:hidden;
    position:relative;
    min-height:200px;
    width:100%;
}
.bk-viz-loading{
    position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
    flex-direction:column; gap:10px; color:#94a3b8; font-size:.85rem;
    background:var(--bk-dark);
}
.bk-viz-loading .bk-spinner{
    width:34px; height:34px; border-radius:50%;
    border:3px solid rgba(148,163,184,.25); border-top-color:var(--bk-accent);
    animation:bk-spin 0.9s linear infinite;
}
@keyframes bk-spin{ to{ transform:rotate(360deg); } }
.bk-viz-wrap iframe{ position:relative; z-index:1; background:var(--bk-dark); width:100%; }

@media (max-width: 576px){
    .bk-banner h1{ font-size:1.2rem; }
    .bk-stat-value{ font-size:1.4rem; }
    .bk-chart-box{ height:260px; }
}
</style>

<div class="bk-ui">

    <!-- Banner -->
    <div class="bk-banner">
        <div class="bk-eyebrow"><i class="fas fa-wrench"></i> Sistem Informasi Geografis Bengkel</div>
        <h1 class="bk-heading">Selamat datang di Dashboard</h1>
        <p>Pantau persebaran bengkel, kategori layanan, dan wilayah cakupan dalam satu tampilan.</p>
    </div>

    <!-- Stat cards -->
    <div class="bk-stat-row">
        <div class="bk-stat-card">
            <span class="bk-stat-icon c-wilayah"><i class="fas fa-map-marked-alt"></i></span>
            <div>
                <div class="bk-stat-label">Total Wilayah</div>
                <div class="bk-stat-value"><?= $total_wilayah ?> <small>Kecamatan</small></div>
            </div>
        </div>
        <div class="bk-stat-card">
            <span class="bk-stat-icon c-bengkel"><i class="fas fa-tools"></i></span>
            <div>
                <div class="bk-stat-label">Total Bengkel</div>
                <div class="bk-stat-value"><?= $total_bengkel ?> <small>Titik</small></div>
            </div>
        </div>
        <div class="bk-stat-card">
            <span class="bk-stat-icon c-kategori"><i class="fas fa-tags"></i></span>
            <div>
                <div class="bk-stat-label">Kategori</div>
                <div class="bk-stat-value"><?= $total_kategori ?> <small>Jenis</small></div>
            </div>
        </div>
        <div class="bk-stat-card">
            <span class="bk-stat-icon c-users"><i class="fas fa-users"></i></span>
            <div>
                <div class="bk-stat-label">Total Users</div>
                <div class="bk-stat-value"><?= $total_users ?> <small>Admin</small></div>
            </div>
        </div>
    </div>

    <!-- Quick links -->
    <div class="bk-card">
        <h3 class="bk-card-title bk-heading"><i class="fas fa-bolt"></i> Akses Cepat</h3>
        <div class="bk-tick-rule"></div>
        <div class="bk-quick-grid">
            <a href="<?= base_url('Bengkel') ?>" class="bk-quick-link">
                <span class="bk-quick-icon"><i class="fas fa-tools"></i></span>
                <span>Kelola Bengkel</span>
            </a>
            <a href="<?= base_url('Kategori') ?>" class="bk-quick-link">
                <span class="bk-quick-icon"><i class="fas fa-tags"></i></span>
                <span>Kelola Kategori</span>
            </a>
            <a href="<?= base_url('Wilayah') ?>" class="bk-quick-link">
                <span class="bk-quick-icon"><i class="fas fa-map-marked-alt"></i></span>
                <span>Kelola Wilayah</span>
            </a>
            <a href="<?= base_url('Admin/Setting') ?>" class="bk-quick-link">
                <span class="bk-quick-icon"><i class="fas fa-cog"></i></span>
                <span>Pengaturan Web</span>
            </a>
        </div>
    </div>

    <!-- Distribution charts -->
    <div class="bk-card">
        <h3 class="bk-card-title bk-heading"><i class="fas fa-chart-pie"></i> Distribusi Bengkel</h3>
        <div class="bk-tick-rule"></div>
        <div class="bk-chart-row">
            <div class="bk-chart-box">
                <canvas id="chartKategori"></canvas>
                <?php if (empty($kategori_chart)): ?><p class="bk-empty-note">Belum ada data kategori bengkel.</p><?php endif; ?>
            </div>
            <div class="bk-chart-box">
                <canvas id="chartWilayah"></canvas>
                <?php if (empty($wilayah_chart)): ?><p class="bk-empty-note">Belum ada data wilayah bengkel.</p><?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Google Data Studio visualization -->
    <div class="bk-viz-header">
        <h3 class="bk-heading"><i class="fas fa-chart-bar mr-1"></i> <b>Visualisasi Data & Analisis Sistem Informasi Geografis</b></h3>
    </div>
    <div class="bk-viz-wrap">
        <div class="bk-viz-loading" id="vizLoading">
            <div class="bk-spinner"></div>
            <span>Memuat visualisasi data...</span>
        </div>
        <iframe
            src="https://datastudio.google.com/embed/reporting/39f8f20b-a27d-494c-af5b-f4e4591e76c8/page/pDhxF"
            frameborder="0"
            style="width: 100%; min-width: 100%; height: 800px; border: 0; display: block;"
            allowfullscreen
            onload="document.getElementById('vizLoading').style.display='none'"
            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
        </iframe>
    </div>

</div>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
(function(){
    var kategoriData = <?= json_encode($kategori_chart) ?>;
    var wilayahData  = <?= json_encode($wilayah_chart) ?>;

    var palette = ['#0f766e','#f59e0b','#ea580c','#0ea5e9','#7c3aed','#16a34a','#db2777','#64748b'];

    if (kategoriData.length && document.getElementById('chartKategori')) {
        new Chart(document.getElementById('chartKategori'), {
            type: 'doughnut',
            data: {
                labels: kategoriData.map(function(d){ return d.label || 'Tanpa kategori'; }),
                datasets: [{
                    data: kategoriData.map(function(d){ return d.jumlah; }),
                    backgroundColor: palette,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, /* FIX BUG: cegah chart melar/loncat ukuran */
                plugins: {
                    legend: { position: 'bottom', labels: { font: { family: 'Inter', size: 11 } } },
                    title: { display: true, text: 'Bengkel per Kategori', font: { family: 'Space Grotesk', size: 13 } }
                }
            }
        });
    }

    if (wilayahData.length && document.getElementById('chartWilayah')) {
        new Chart(document.getElementById('chartWilayah'), {
            type: 'bar',
            data: {
                labels: wilayahData.map(function(d){ return d.label || 'Tanpa wilayah'; }),
                datasets: [{
                    label: 'Jumlah Bengkel',
                    data: wilayahData.map(function(d){ return d.jumlah; }),
                    backgroundColor: '#0f766e',
                    borderRadius: 6,
                    maxBarThickness: 28
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, /* FIX BUG: cegah chart melar/loncat ukuran */
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Bengkel per Wilayah', font: { family: 'Space Grotesk', size: 13 } }
                },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
            }
        });
    }
})();
</script>