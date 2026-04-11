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

            <?php echo form_open() ?>

             
            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                    <label>Nama Bengkel</label>
                    <input name="nama_bengkel" class="form-control" placeholder="Nama Bengkel">
                  </div>
                </div>
                <div class="col-sm-3">
                <div class="form-group">
                    <label>Coordinat Wilayah</label>
                    <input name="coordinat_wilayah" class="form-control" placeholder="Coordinat Wilayah">
                  </div>
                </div>

                <div class="col-sm-2">
                <div class="form-group">
                    <label>Zoom View</label>
                    <input type="number" name="coordinat_wilayah" min="0" max="20" class="form-control" placeholder="Coordinat Wilayah">
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
            <div id="map" style="width: 100%; height: 730px;"></div>
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

	//const map = L.map('map').setView([-7.2575022267624565, 109.0062579249614], 13);

	//const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	//	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	//}).addTo(map);

const map = L.map('map', {
    center: [-7.2575022267624565, 109.0062579249614],
    zoom: 12,
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