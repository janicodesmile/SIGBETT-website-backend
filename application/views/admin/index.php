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


        <div class="col-lg-12 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3> <?= $totalbengkel ?> </h3>

                <p>Data bengkel</p>
              </div>
              <div class="icon">
                <i class="fas fa-tools"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


        <?= $map['html']; ?>

        


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>