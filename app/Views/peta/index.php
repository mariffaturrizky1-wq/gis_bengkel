<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #1a1a1a; color: #fff; }
        .card { background-color: #262626; border: 1px solid #3d3d3d; color: #fff; }
        .text-orange { color: #ff6600; }
        .btn-orange { background-color: #ff6600; color: #fff; }
        .btn-orange:hover { background-color: #e65c00; color: #fff; }
        .map-placeholder {
            height: 500px;
            background-color: #1f1f1f;
            border: 2px dashed #ff6600;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-orange"><i class="fa-solid fa-map-location-dot"></i> Peta Lokasi Bengkel</h1>
        <p class="lead text-white-50"><?= $subtitle; ?></p>
        <hr class="mx-auto" style="width: 100px; border-top: 3px solid #ff6600;">
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card p-3 shadow h-100">
                <h5 class="text-orange mb-3 fw-bold"><i class="fa-solid fa-filter"></i> Filter Bengkel</h5>
                
                <div class="mb-3">
                    <label class="form-label text-white-50">Pilih Wilayah</label>
                    <select class="form-select bg-dark text-white border-secondary">
                        <option value="">-- Semua Wilayah --</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label text-white-50">Kategori Bengkel</label>
                    <select class="form-select bg-dark text-white border-secondary">
                        <option value="">-- Semua Kategori --</option>
                        <?php foreach ($kategori as $k) : ?>
                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mt-auto d-grid gap-2">
                    <a href="<?= base_url('auth/login'); ?>" class="btn btn-orange fw-bold">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Login
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card p-3 shadow">
                <div class="map-placeholder">
                    <div class="text-center">
                        <i class="fa-solid fa-earth-asia fa-spin text-orange mb-3" style="font-size: 4rem;"></i>
                        <h4 class="fw-semibold">Area Peta GIS</h4>
                        <p class="text-white-50 px-4">Siap untuk diintegrasikan dengan Leaflet.js / Google Maps API</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>