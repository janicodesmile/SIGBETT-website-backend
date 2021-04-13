  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1 class="h3 mb-4 text-gray-800"><?= $judul?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/kustomer">Lihat Kustomer</a></li>
              <li class="breadcrumb-item active"><?= $judul?></li>
            </ol>
          </div>
        </div>
      <?= form_open_multipart('admin/ubahBengkel/'.$bengkel['id_bengkel']);?>


        <div class="card">
            <div class="card-body">

              <div class="callout callout-warning">
                <h5>Nama Bengkel</h5>
                <input type="text" class="form-control" name="nama" value="<?= $bengkel['nama_bengkel'] ?>">
                <?= form_error('nama','<small class="text-danger pl-3">', '</small>'); ?>
              </div>


                <input type="hidden" class="form-control" name="old_image" value="<?= $bengkel['gambar_sampul'] ?>">

             <div class="callout callout-warning">
                <h5>Pilih Kecamatan</h5>
                <div class="form-group">
                  <select class="kecamatan form-control" id="kecamatan" name="kecamatan">
                    <option value="0">Pilih Kecamatan</option>
                  <?php foreach($kec as $u){ ?>
                     <?php if($u->nama_kecamatan == $bengkel['nama_kecamatan']) : ?>
                    <option value="<?= $u->id ?>" selected ><?= $u->nama_kecamatan ?></option>
                    <?php else : ?>
                      <option value="<?= $u->id ?>"><?= $u->nama_kecamatan ?></option>
                    <?php endif; ?>
                  <?php } ?>
                  </select>
                </div>
                <?= form_error('no_pol','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Pilih Kelurahan</h5>
                <div class="form-group">
                  <select class="kelurahan form-control" id="kelurahan" name="kelurahan">
                    <?php foreach($kel as $b){ ?>
                      <?php if($b->nama_kel == $bengkel['nama_kel']) : ?>
                    <option value="<?= $b->id ?>" selected><?= $b->nama_kel ?></option>
                    <?php else : ?>
                      <option value="<?= $b->id ?>"><?= $b->nama_kel ?></option>
                    <?php endif; ?>
                    <?php } ?>
                  </select>
                </div>
                <?= form_error('no_pol','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Latitude</h5>
                <input type="text" class="form-control" name="latitude" value="<?= $bengkel['long'] ?>">
                <?= form_error('latitude','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Longitude</h5>
                <input type="text" class="form-control" name="longitude" value="<?= $bengkel['lat'] ?>">
                <?= form_error('longitude','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Nomor Telephone</h5>
                <input type="text" class="form-control" name="no_hp" value="<?= $bengkel['no_hp'] ?>">
                <?= form_error('no_hp','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Nama Pemilik</h5>
                <input type="text" class="form-control" name="nama_pemilik" value="<?= $bengkel['nama_pemilik'] ?>">
                <?= form_error('nama_pemilik','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <?php $d=explode(', ', $bengkel['hari_kerja1']);?>
              <?php print_r($d);
              foreach ($d as $hari) {
                 echo $hari;
               } ?>

              <div class="callout callout-warning">
                <h5>Hari kerja</h5>
                 <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox1" value="1" <?=(in_array("1",$d) ? 'checked=""' : '')?> >
                  <label class="form-check-label" for="inlineCheckbox1">Senin</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox2" value="2"  <?=(in_array("2",$d) ? 'checked=""' : '')?>>
                  <label class="form-check-label" for="inlineCheckbox2">Selasa</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox3" value="3"  <?=(in_array("3",$d) ? 'checked=""' : '')?>>
                  <label class="form-check-label" for="inlineCheckbox3">Rabu</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox4" value="4"  <?=(in_array("4",$d) ? 'checked=""' : '')?>>
                  <label class="form-check-label" for="inlineCheckbox4">Kamis</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox5" value="5"  <?=(in_array("5",$d) ? 'checked=""' : '')?>>
                  <label class="form-check-label" for="inlineCheckbox5">Jumat</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox6" value="6"  <?=(in_array("6",$d) ? 'checked=""' : '')?>>
                  <label class="form-check-label" for="inlineCheckbox6">Sabtu</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox7" value="7"  <?=(in_array("7",$d) ? 'checked=""' : '')?>>
                  <label class="form-check-label" for="inlineCheckbox7">Minggu</label>
                </div>
              </div>

              <div class="callout callout-warning">
                <h5>Jam Buka</h5>
                <input type="text" class="form-control" name="jam_buka" value="<?= $bengkel['jam_buka'] ?>">
                <?= form_error('jam_buka','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Jam Tutup</h5>
                <input type="text" class="form-control" name="jam_tutup" value="<?= $bengkel['jam_tutup'] ?>">
                <?= form_error('jam_tutup','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

               <div class="callout callout-warning">
                <h5>Alamat bengkel</h5>
                <input type="text" class="form-control" name="alamat" value="<?= $bengkel['alamat_bengkel'] ?>">
                <?= form_error('alamat','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
              <h5>Gambar Sampul</h5>
                <div class="row">
                  <div class="col-sm-4">
                    <a target="_blank" href="<?= base_url(); ?>/dist/img/sampul/<?= $bengkel['gambar_sampul'] ?>">
                      <img src="<?= base_url(); ?>/dist/img/sampul/<?= $bengkel['gambar_sampul']?>" id="imgView" height="200" width="200">
                    </a>
                  </div>
                  <div class="col-sm-8">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" name="image">
                      <label class="custom-file-label " for="image">Choose file</label>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" name="gambar" value="<?= $bengkel['gambar_sampul'] ?>">

               <input type="submit" name="tambah-bus" class="btn btn-info float-sm-right" value="Ubah">
              </a>
              <a href="<?= base_url();?>admin/bengkel" class="btn btn-danger float-sm-right">
              <i class="far fa-times-circle"></i> Batal
              </a>

        </div>    
      </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->