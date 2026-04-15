<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <?php
              if (session()->getFlashdata('pesan')){
                echo ' <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>';
                echo (session()->getFlashdata('pesan'));
                echo '</div>';
              }
              
              ?>

            <?php echo form_open('Admin/UpdateSetting') ?>

             
            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                    <label>Nama Website</label>
                    <input name="nama_web" value="<?= $web['nama_web']?>" class="form-control" placeholder="Nama Website"required>
                  </div>
                </div>
                <div class="col-sm-3">
                <div class="form-group">
                    <label>Coordinat Wilayah</label>
                    <input name="coordinat_wilayah" value="<?= $web['coordinat_wilayah']?>" class="form-control" placeholder="Coordinat Wilayah"required>
                  </div>
                </div>

                <div class="col-sm-2">
                <div class="form-group">
                    <label>Zoom View</label>
                    <input type="number" value="<?= $web['zoom_view']?>" name="zoom_view" min="0" max="20" class="form-control" placeholder="Coordinat Wilayah"required>
                  </div>
                </div>
            </div>


            <button class="btn btn-primary" type="submit">Simpan</button>
           

           
                <?php echo form_close() ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


            <div class="col-md-12">
              <div id="map" style="width: 100%; height: 750px;"></div>
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
    center: [<?= $web['coordinat_wilayah']?>],
    zoom: <?= $web['zoom_view']?>,
    layers: [peta1]
});

const baseMaps = {
    'OpenStreetMap': peta1,
    'Topo Map': peta2,
    'HOT Map': peta3,
    'Stadia Map': peta4
};

var layerControl = L.control.layers(baseMaps).addTo(map);

</script>