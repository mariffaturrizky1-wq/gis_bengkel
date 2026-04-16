<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">

            <?php echo form_open('Wilayah/InsertData') ?>
        
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Wilayah</label>
                        <input name="nama_wilayah" class="form-control">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Warna Wilayah</label>
                        <input name="warna" class="form-control my-colorpicker1">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>GeoJSON</label>
                <textarea name="grojson" class="form-control" rows="15"></textarea>
            </div>

            <button class="btn btn-primary btn_flat" type="submit">Simpan</button>
            <a href="<?= base_url('Wilayah')?>" class="btn btn-success btn_flat">Kembali</a>

            <?php echo form_close() ?>

        </div>
    </div>
</div>

<script>
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
</script>
