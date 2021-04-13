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
      <?= form_open_multipart('admin/tambahBengkel');?>
        <div class="card">
            <div class="card-body">

              <div class="callout callout-warning">
                <h5>Nama Bengkel</h5>
                <input type="text" class="form-control" name="nama" placeholder="masukkan Nama Bengkel...">
                <?= form_error('nama','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

             <div class="callout callout-warning">
                <h5>Pilih Kecamatan</h5>
                <div class="form-group">
                  <select class="kecamatan form-control" id="kecamatan" name="kecamatan">
                    <option value="0">Pilih Kecamatan</option>
                  <?php foreach($kec as $u){ ?>
                    <option value="<?= $u->id ?>"><?= $u->nama_kecamatan ?></option>
                  <?php } ?>
                  </select>
                </div>
                <?= form_error('no_pol','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Pilih Kelurahan</h5>
                <div class="form-group">
                  <select class="kelurahan form-control" id="kelurahan" name="kelurahan">
                    <option>Pilih dulu kecamatan</option>
                  </select>
                </div>
                <?= form_error('no_pol','<small class="text-danger pl-3">', '</small>'); ?>
              </div>


              <div class="callout callout-warning">
              <h5>Lokasi Bengkel</h5>
                <div class="row">
                  <div class="col-sm-8">
                    <?= $map['html'] ?>
                  </div>
                  <div class="col-sm-4">
                     <div class="callout callout-warning">
                      <h5>Latitude</h5>
                      <input type="text" class="form-control" name="latitude" placeholder="Masukkan Latitude...">
                      <?= form_error('latitude','<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="callout callout-warning">
                      <h5>Longitude</h5>
                      <input type="text" class="form-control" name="longitude" placeholder="Masukkan Longitude...">
                      <?= form_error('longitude','<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>
                </div>
              </div>

             

              <div class="callout callout-warning">
                <h5>Nomor Telephone</h5>
                <input type="text" class="form-control" name="no_hp" placeholder="Masukkan No Telepon...">
                <?= form_error('no_hp','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Nama Pemilik</h5>
                <input type="text" class="form-control" name="nama_pemilik" placeholder="Masukkan Nama Pemilik...">
                <?= form_error('nama_pemilik','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Hari kerja</h5>
                 <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox1" value="1">
                  <label class="form-check-label" for="inlineCheckbox1">Senin</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox2" value="2">
                  <label class="form-check-label" for="inlineCheckbox2">Selasa</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox3" value="3">
                  <label class="form-check-label" for="inlineCheckbox3">Rabu</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox4" value="4">
                  <label class="form-check-label" for="inlineCheckbox4">Kamis</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox5" value="5">
                  <label class="form-check-label" for="inlineCheckbox5">Jumat</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox6" value="6">
                  <label class="form-check-label" for="inlineCheckbox6">Sabtu</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hari[]" id="inlineCheckbox7" value="7">
                  <label class="form-check-label" for="inlineCheckbox7">Minggu</label>
                </div>
              </div>

              <div class="callout callout-warning">
                <h5>Jam Buka</h5>
                <input type="text" class="form-control" name="jam_buka" placeholder="Ex : 08.00">
                <?= form_error('jam_buka','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Jam Tutup</h5>
                <input type="text" class="form-control" name="jam_tutup" placeholder="Ex : 16.00">
                <?= form_error('jam_tutup','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Alamat bengkel</h5>
                <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat...">
                <?= form_error('alamat','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Gambar</h5>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image" name="image">
                  <label class="custom-file-label " for="image">Choose file</label>
                </div>

                <?= form_error('nama','<small class="text-danger pl-3">', '</small>'); ?>
                <div class="imgWrap">
                    <img src="" id="imgView" class="card-img-top img-fluid">
                </div>
                <?= form_error('image','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

               <input type="submit" name="tambah-bus" class="btn btn-info float-sm-right" value="Tambah">
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