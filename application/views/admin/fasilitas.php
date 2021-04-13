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

        <div class="card">
            <div class="card-header">
             <a href="<?= base_url(); ?>/admin/tambahFasilitas" class="btn btn-primary">
               <i class="fa fa-plus">
                 Tambah Data fasilitas
               </i>
             </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nomor</th>
                      <th>Nama Bengkel</th>
                      <th>Banyak fasilitas</th>
                      <th>Fasilitas</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nomor</th>
                      <th>Nama Bengkel</th>
                      <th>Banyak fasilitas</th>
                      <th>Fasilitas</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                      $no = 0;
                      foreach($fasilitas as $u){ 
                        $no++
                      ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td> <?= $u->nama_bengkel ?> </td>
                      <td><?= $u->total ?></td>
                      <td>
                        <?php foreach($dataFas as $p){ ?>
                          <?php if($p->id_bengkel == $u->id_bengkel) { ?>
                            <a target="_blank" href="<?= base_url(); ?>dist/img/icon/<?= $p->icon ?>">
                              <img src="<?= base_url(); ?>dist/img/icon/<?= $p->icon ?>" height="40" width="45">
                              <?= $p->nama_fas ?>
                            </a><br><br>
                          <?php } ?>
                      <?php } ?>
                      </td>
                        <td>
                          <center>
                            <a href="<?= base_url(); ?>Admin/detailFasilitas/<?= $u->id_bengkel ?>" class="btn btn-sm btn-info" title="Detail">
                                <i class="fas fa-info-circle"></i>
                            </a>
                          </center>
                        </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->