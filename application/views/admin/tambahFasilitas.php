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
      <?= form_open_multipart('admin/tambahFasilitas');?>
        <div class="card">
            <div class="card-body">

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
                <h5>Nama Bengkel</h5>
                <select class="nama_bengkel form-control" id="nama_bengkel" name="nama_bengkel">
                    <option>Pilih dulu Kelurahan</option>
                </select>
                <?= form_error('nama_bengkel','<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="callout callout-warning">
                <h5>Fasilitas</h5>
                <select class="fasilitas form-control" id="fasilitas" name="fasilitas">
                    <option value="0">Pilih Fasilitas</option>
                  <?php foreach($dataFas as $u){ ?>
                    <option value="<?= $u->id_fas ?>" style=""><?= $u->nama_fas ?></option>
                  <?php } ?>
                  </select>
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