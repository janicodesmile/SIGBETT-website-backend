  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>admin/" class="brand-link">
      <img height="60px" src="<?= base_url(); ?>/dist/img/logo_kota.png"
           alt="SIGBETT"
           style="opacity: .8">
           SIGBETT
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url(); ?>dist/img/admin.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">administrator</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
 <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Halaman Utama
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/Bengkel" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Data Bengkel
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/gambar" class="nav-link">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Data Gambar
              </p>
            </a>
          </li>    

          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/fasilitas" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Data Fasilitas
              </p>
            </a>
          </li>           

         <!--  <li class="nav-item">
            <a href="<?= base_url(); ?>admin/pemesanan" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Data Pemesanan
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/bayar" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Data Pembayaran
              </p>
            </a>
          </li>  -->

         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>