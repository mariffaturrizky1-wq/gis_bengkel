<div class="col-md-12">
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header bg-white">
            <h3 class="card-title font-weight-bold text-secondary">
                <i class="fas fa-info-circle text-primary mr-2"></i> <?= $judul ?>
            </h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div id="map" class="shadow-sm border rounded" style="width: 100%; height: 500px;"></div>
                </div>

                <div class="col-sm-6 mb-3">
                    <img src="<?= base_url('foto/'. $bengkel['foto'])?>" class="img-fluid shadow-sm border rounded" style="width: 100%; height: 500px; object-fit: cover;">
                </div>

                <div class="col-sm-12 mt-3">
                    <table class="table table-hover table-striped border">
                        <tr>
                            <th width="200px" class="text-secondary">Nama Bengkel</th>
                            <td width="30px" class="text-center">:</td>
                            <td class="font-weight-bold text-dark"><?= $bengkel['nama_bengkel'] ?></td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Kategori</th>
                            <td class="text-center">:</td>
                            <td><span class="badge badge-info px-3 py-2"><?= $bengkel['kategori'] ?></span></td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Jam Buka</th>
                            <td class="text-center">:</td>
                            <td class="font-weight-bold text-success"><?= substr($bengkel['jam_buka'], 6, 2) . ':00' ?></td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Jam Tutup</th>
                            <td class="text-center">:</td>
                            <td class="font-weight-bold text-danger"><?= substr($bengkel['jam_tutup'], 6, 2) . ':00' ?></td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Alamat</th>
                            <td class="text-center">:</td>
                            <td class="text-muted">
                                <?= $bengkel['alamat'] ?>, <?= $bengkel['nama_kecamatan'] ?>, <?= $bengkel['nama_kabupaten'] ?>, <?= $bengkel['nama_provinsi'] ?>.
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var peta1 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    });

    var peta2 = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenTopoMap'
    });

    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap HOT'
    });

    var peta4 = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}.png', {
        attribution: '&copy; Stadia Maps'
    });
        
    const map = L.map('map', {
        center: [<?= $bengkel['coordinat'] ?>],
        zoom: <?= $web['zoom_view'] ?>,
        layers: [peta1]
    });

    const baseMaps = {
        'OpenStreetMap': peta1,
        'Topo Map': peta2,
        'HOT Map': peta3,
        'Stadia Map': peta4
    };

    L.geoJSON(<?= $bengkel['geojson']?>, {
        fillColor: '<?= $bengkel['warna']?>',
        fillOpacity: 0.5,
    }).bindPopup("<b><?= $bengkel['nama_wilayah'] ?><b>")
    .addTo(map);

    var icon = L.icon({
        iconUrl: '<?= base_url('marker/' . $bengkel['marker']) ?>',
        iconSize: [40, 50], // size of the icon
    });
    L.marker([<?= $bengkel['coordinat'] ?>],{
        icon: icon
    }).addTo(map);
</script>