<?php 
// File: app/Views/v_dashboard.php

// Ambil koneksi database langsung di dalam view agar auto-env tanpa crash controller
$db = \Config\Database::connect();

// Hitung total data langsung (Sesuaikan nama tabel jika berbeda)
$total_wilayah  = $db->table('tbl_wilayah')->countAllResults(); 
$total_bengkel  = $db->table('tbl_bengkel')->countAllResults(); 
$total_kategori = $db->table('tbl_kategori')->countAllResults(); 
$total_users    = $db->table('tbl_user')->countAllResults(); 
?>

<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box elevation-1">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-map-marked-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Wilayah</span>
                <span class="info-box-number"><?= $total_wilayah ?> <small>Kecamatan</small></span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box elevation-1">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tools"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Bengkel</span>
                <span class="info-box-number"><?= $total_bengkel ?> <small>Titik</small></span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box elevation-1">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tags text-white"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Kategori</span>
                <span class="info-box-number"><?= $total_kategori ?> <small>Jenis</small></span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box elevation-1">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number"><?= $total_users ?> <small>Admin</small></span>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card card-outline card-warning mb-0" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
            <div class="card-header bg-warning">
                <h3 class="card-title text-dark">
                    <i class="fas fa-chart-bar mr-1"></i> 
                    <b>Visualisasi Data & Analisis Sistem Informasi Geografis</b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus text-dark"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="width: 100%; clear: both; padding: 0; margin: 0; background-color: #1e293b; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,.1); overflow: hidden;">
    
    <iframe 
        src="https://datastudio.google.com/embed/reporting/39f8f20b-a27d-494c-af5b-f4e4591e76c8/page/pDhxF" 
        frameborder="0" 
        style="width: 100%; min-width: 100%; height: 800px; border: 0; display: block; overflow: hidden;" 
        allowfullscreen 
        sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
    </iframe>

</div>