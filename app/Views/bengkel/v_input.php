<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">

            <?php
            session();
            $validation = session()->get('validation') ?? \Config\Services::validation();
            ?>

            <?php echo form_open_multipart('Bengkel/InsertData') ?>
        
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nama Bengkel</label>
                        <input name="nama_bengkel" value="<?= old('nama_bengkel')?>" placeholder="Nama Bengkel" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('nama_bengkel') ? $validation->getError('nama_bengkel') : '' ?></p>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Jam Buka</label>
                        <input name="jam_buka" value="<?= old('jam_buka')?>" placeholder="Jam Buka" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('jam_buka') ? $validation->getError('jam_buka') : '' ?></p>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Jam Tutup</label>
                        <input name="jam_tutup" value="<?= old('jam_tutup')?>" placeholder="Jam Tutup" class="form-control">
                        <p class="text-danger"><?= $validation->hasError('jam_tutup') ? $validation->getError('jam_tutup') : '' ?></p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control">
                            <option value="">--Pilih Kategori--</option>
                            <option value="Motor">Motor</option>
                            <option value="Mobil">Mobil</option>
                        </select>
                        <p class="text-danger"><?= $validation->hasError('kategori') ? $validation->getError('kategori') : '' ?></p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Coordinat Bengkel</label>
                <div id="map" style="width: 100%; height: 500px;"></div>
                <input name="coordinat" id="Coordinat"   value="<?= old('coordinat')?>" placeholder="Coordinat Bengkel" class="form-control" readonly>
                    <p class="text-danger"><?= $validation->hasError('coordinat') ? $validation->getError('coordinat') : '' ?></p>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="id_provinsi" id="id_provinsi" class="form-control select2" style="width: 100%;">
                        <option value="">---Pilih Provinsi---</option>
                        <?php foreach ($provinsi as $key => $value) { ?> 
                            <option value="<?= $value['id_provinsi'] ?>"><?= $value['nama_provinsi'] ?></option>
                        <?php } ?>
                        </select>
                        <p class="text-danger"><?= $validation->hasError('id_provinsi') ? $validation->getError('id_provinsi') : '' ?></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kabupaten</label>
                        <select name="id_kabupaten" id="id_kabupaten" class="form-control">
                        </select>
                        <p class="text-danger"><?= $validation->hasError('id_kabupaten') ? $validation->getError('id_kabupaten') : '' ?></p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <select name="id_kecamatan" id="id_kecamatan" class="form-control">
                        </select>
                        <p class="text-danger"><?= $validation->hasError('id_kecamatan') ? $validation->getError('id_kecamatan') : '' ?></p>
                    </div>
                </div>
            </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                        <label>Alamat</label>
                        <input name="alamat" value="<?= old('alamat')?>" placeholder="Alamat Bengkel"class="form-control">
                        <p class="text-danger"><?= $validation->hasError('alamat') ? $validation->getError('alamat') : '' ?></p>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Wilayah Administrasi</label>
                        <select name="id_wilayah" class="form-control">
                        <option value="">---Pilih Wilayah Administrasi---</option>
                        <?php foreach ($Wilayah as $key => $value) { ?> 
                            <option value="<?= $value['id_wilayah'] ?>"><?= $value['nama_wilayah'] ?></option>
                        <?php } ?>   
                        </select>
                        <p class="text-danger"><?= $validation->hasError('id_wilayah') ? $validation->getError('id_wilayah') : '' ?></p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Foto Bengkel</label>
                <input type="file" accept="image/*" name="foto" class="form-control">
                <p class="text-danger"><?= $validation->hasError('foto') ? $validation->getError('foto') : '' ?></p>
            </div>


            <a href="<?= base_url('Wilayah')?>" class="btn btn-success btn_flat">Kembali</a>
            <button class="btn btn-primary btn_flat" type="submit">Simpan</button>

            <?php echo form_close() ?>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Initialize Select2 Elements
        $('.select2').select2();

        // Dropdown Kabupaten
        $('#id_provinsi').change(function() {
            var id_provinsi = $(this).val();
            if (id_provinsi != "") {
                $.ajax({
                    type: "GET", 
                    url: "<?= base_url('bengkel/kabupaten') ?>", // Pastikan huruf kecil semua agar aman
                    data: { id_provinsi: id_provinsi },
                    success: function(response) {
                        $('#id_kabupaten').html(response);
                        // Reset kecamatan saat provinsi ganti
                        $('#id_kecamatan').html('<option value="">--Pilih Kecamatan--</option>');
                    }
                });
            }
        });

        // Dropdown Kecamatan
        $('#id_kabupaten').change(function() {
            var id_kabupaten = $(this).val(); // Lebih ringkas pakai $(this)
            if (id_kabupaten != "") {
                $.ajax({
                    type: "GET", // Disamakan pakai GET agar tidak error CSRF
                    url: "<?= base_url('bengkel/kecamatan') ?>", // Arahkan ke controller Bengkel
                    data: { id_kabupaten: id_kabupaten },
                    success: function(response) {
                        $('#id_kecamatan').html(response);
                    }
                });
            }
        });
    });
</script>


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
        center: [<?= $web['coordinat_wilayah'] ?>],
        zoom: <?= $web['zoom_view'] ?>,
        layers: [peta1]
    });

    const baseMaps = {
        'OpenStreetMap': peta1,
        'Topo Map': peta2,
        'HOT Map': peta3,
        'Stadia Map': peta4
    };

    var layerControl = L.control.layers(baseMaps).addTo(map);

    var coordinatInput = document.querySelector("[name=coordinat]"); 

    var curLocation = [<?= $web['coordinat_wilayah'] ?>];
    map.attributionControl.setPrefix(false);
    var marker = new L.marker(curLocation, {
        draggable: 'true',
    });
     
    //mengambil coordinat saat marker digeser
    marker.on('dragend',function(e) {
        var position = marker.getLatLng();
        marker.setLatLng(position,{
            curLocation
        }).bindPopup(position).update();
        $('#Coordinat').val(position.lat +  "," + position.lng);
    });

    //mengambil coordinat saat map onclick
    map.on("click", function(e){
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        }else{
            marker.setLatLng(e.latlng);
        }
        coordinatInput.value=lat+ ',' +lng
    })

    map.addLayer(marker);
</script>