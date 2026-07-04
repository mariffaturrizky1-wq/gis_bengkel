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
        <h1 class="fw-bold text-orange"><i class="fa-solid fa-map-location-dot"></i> GIS Bengkel</h1>
        <p class="lead text-white-50"><?= $subtitle; ?></p>
        <hr class="mx-auto" style="width: 100px; border-top: 3px solid #ff6600;">
    </div>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card h-100 p-4 shadow">
                <h3 class="mb-4 text-orange fw-semibold">Informasi Layanan</h3>
                
                <div class="d-flex align-items-center mb-4">
                    <div class="fs-3 text-orange me-3" style="width: 40px; text-align: center;">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold text-white">Email Resmi</h6>
                        <span class="text-white-50 fs-6"><?= $email; ?></span>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4">
                    <div class="fs-3 text-orange me-3" style="width: 40px; text-align: center;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold text-white">Call Center / WhatsApp</h6>
                        <span class="text-white-50 fs-6"><?= $telepon; ?></span>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4">
                    <div class="fs-3 text-orange me-3" style="width: 40px; text-align: center;">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold text-white">Jam Operasional</h6>
                        <span class="text-white-50 fs-6"><?= $jam_kerja; ?></span>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4">
                    <div class="fs-3 text-orange me-3" style="width: 40px; text-align: center;">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold text-white">Kantor Pusat</h6>
                        <span class="text-white-50 fs-6"><?= $alamat; ?></span>
                    </div>
                </div>
                
                <a href="<?= base_url('auth/login'); ?>" class="btn btn-outline-light mt-5">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Login
                </a>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card p-4 shadow">
                <h3 class="mb-4 text-orange fw-semibold">Hubungi Administrator</h3>
                <form action="#" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-white">Nama Lengkap</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Alamat Email</label>
                        <input type="email" class="form-control bg-dark text-white border-secondary" placeholder="nama@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Subjek / Perihal</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: Masalah Akun, Error Peta, dll." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Isi Pesan</label>
                        <textarea class="form-control bg-dark text-white border-secondary" rows="4" placeholder="Tuliskan kendala atau pertanyaan Anda secara detail..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-orange w-100 fw-bold py-2 mt-2">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>