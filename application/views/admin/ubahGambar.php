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
      <?= form_open_multipart('admin/ubahGambar/'.$gambar['id']);?>
        <div class="card">
            <div class="card-body">
              <div class="callout callout-warning">
                <h5>Pilih Kecamatan</h5>
                <div class="form-group">
                  <select class="kecamatan form-control" id="kecamatan" name="kecamatan">
                    <option value="0">Pilih Kecamatan</option>
                  <?php foreach($kec as $u){ ?>
                     <?php if($u->id == $gambar['id_kecamatan']) : ?>
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
                      <?php if($b->id == $gambar['id_kelurahan']) : ?>
                    <option value="<?= $b->id ?>" selected><?= $b->nama_kel ?></option>
                    <?php else : ?>
                      <option value="<?= $b->id ?>"><?= $b->nama_kel ?></option>
                    <?php endif; ?>
                    <?php } ?>
                  </select>
                </div>
                <?= form_error('no_pol','<small class="text-danger pl-3">', '</small>'); ?>
              </div>
<input type="hidden" class="form-control" name="old_image" value="<?= $gambar['gambar'] ?>">
<input type="hidden" class="form-control" name="id_gambar" value="<?= $gambar['id_bengkel'] ?>">
             <div class="callout callout-warning">
                <h5>Nama Bengkel</h5>
                <select class="nama_bengkel form-control" id="nama_bengkel" name="nama_bengkel">
                   <?php foreach($bengkel as $b){ ?>
                      <?php if($b->id_bengkel == $gambar['id_bengkel']) : ?>
                    <option value="<?= $b->id_bengkel ?>" selected><?= $b->nama_bengkel ?></option>
                    <?php else : ?>
                      <option value="<?= $b->id_bengkel ?>"><?= $b->nama_bengkel ?></option>
                    <?php endif; ?>
                    <?php } ?>
                </select>
                <?= form_error('nama_bengkel','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
              <h5>Gambar</h5>
                <div class="row">
                  <div class="col-sm-4">
                    <a target="_blank" href="<?= base_url(); ?>/dist/img/gambar/<?= $gambar['gambar'] ?>">
                      <img src="<?= base_url(); ?>/dist/img/gambar/<?= $gambar['gambar']?>" id="imgView" height="200" width="200">
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
              <input type="hidden" name="gambar" value="<?= $gambar['gambar_sampul'] ?>">

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