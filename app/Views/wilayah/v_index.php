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
                
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th width="50px">No</th>
                            <th>Nama Wilayah</th>
                            <th>Warna</th>
                            <th width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($Wilayah as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_wilayah'] ?></td>
                            <td style="background-color: <?= $value['warna'] ?> ;"></td>
                            <td></td>
                        </tr>
                        <?php    } ?>
                    </tbody>
                </table>

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

<?php foreach ($Wilayah as $key => $value) { ?>
    L.geoJSON(<?= $value['geojson']?>, {
        fillColor: '<?= $value['warna']?>',
        fillOpacity: 0.5,
    }).bindPopup("<b><?= $value['nama_wilayah'] ?><b>")
    .addTo(map);
    <?php } ?>
</script>



<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>