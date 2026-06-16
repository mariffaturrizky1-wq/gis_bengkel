<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div id="map" style="width: 100%; height: 500px;"></div>
                </div>

                <div class="col-sm-6">
                    <img src="<?= base_url('foto/'. $bengkel['foto'])?>"width="100%" height="500px">
                </div>

                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Bengkel</th>
                            <th width="30px">:</th>
                            <th><?= $bengkel ['nama_bengkel'] ?></th>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <th>:</th>
                            <th><?= $bengkel ['kategori'] ?></th>
                        </tr>
                        <tr>
                            <th>Jam Buka</th>
                            <th>:</th>
                            <th><?= $bengkel ['jam_buka'] ?></th>
                        </tr>
                        <tr>
                            <th>Jam Tutup</th>
                            <th>:</th>
                            <th><?= $bengkel ['jam_tutup'] ?></th>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th>:</th>
                            <th><?= $bengkel ['alamat'] ?>, <?= $bengkel ['nama_kecamatan'] ?>, <?= $bengkel ['nama_kabupaten'] ?>, <?= $bengkel ['nama_provinsi'] ?>,</th>
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
        center: [<?= $bengkel ['coordinat'] ?>],
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
    iconSize:     [40, 50], // size of the icon
    });
    L.marker([<?= $bengkel ['coordinat'] ?>],{
        icon: icon
    }).addTo(map);

</script>