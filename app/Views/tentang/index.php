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
    </style>
</head>
<body>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-orange"><i class="fa-solid fa-circle-info"></i> Tentang Aplikasi</h1>
        <p class="lead text-white-50"><?= $subtitle; ?></p>
        <hr class="mx-auto" style="width: 100px; border-top: 3px solid #ff6600;">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card p-5 shadow mb-4">
                <h3 class="text-orange mb-3 fw-semibold">Apa itu GIS Bengkel?</h3>
                <p class="fs-5 text-white-50" style="line-height: 1.8; text-align: justify;">
                    <?= $deskripsi; ?>
                </p>

                <h4 class="text-orange mt-4 mb-3 fw-semibold">Fitur Utama Sistem:</h4>
                <div class="row">
                    <?php foreach ($fitur as $f) : ?>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <span class="text-orange fs-4 me-3"><i class="fa-solid fa-square-check"></i></span>
                                <span class="text-white fs-6 fw-medium"><?= $f; ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-5 d-flex gap-3">
                    <a href="<?= base_url('auth/login'); ?>" class="btn btn-orange px-4 py-2 fw-bold">
                        <i class="fa-solid fa-arrow-left"></i> <?= $teks_tombol; ?>
                    </a>
                    <a href="<?= base_url('kontak'); ?>" class="btn btn-outline-light px-4 py-2">
                        <i class="fa-solid fa-envelope"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>