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
              <li class="breadcrumb-item active"><?= $judul?></li>
            </ol>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
          </div>
        </div>
        <?php foreach($bengkel as $b){ ?>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <a href="<?= base_url(); ?>Admin/ubahGambar/<?= $b->id ?>" name="ubah_data_config" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Data Gambar
              </a>
              <a href="<?= base_url(); ?>Admin/hapusGambar/<?= $b->id ?>" name="ubah_data_config" class="btn btn-danger">
                <i class="fas fa-edit"></i> Hapus Data Gambar
              </a>
            </h3>
          </div>
            <div class="card-body">
              <div class="callout callout-info">
                <h5>Nama Bengkel</h5>
                <input type="text" class="form-control" value="<?= $b->nama_bengkel ?>" readonly>
              </div>
              <div class="callout callout-warning">
                <h5>Gambar Sampul</h5>
                  <a target="_blank" href="<?= base_url(); ?>dist/img/gambar/<?= $b->gambar?>">
                    <img src="<?= base_url(); ?>dist/img/gambar/<?= $b->gambar?>" height="500" width="1000">
                  </a>
              </div>
            </div>
        </div>
        <?php } ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->