    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <i class="fas fa-angry"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sistem Informasi Bengkel</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider ">


      <!-- Heading -->
      <div class="sidebar-heading">
        Admin
      </div>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>Admin ">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</spa n></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>Admin/bengkel">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Data Bengkel</spa n></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Data Gambar</spa n></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        User
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
         <i class="fas fa-fw fa-user"></i>
          <span>My Profile</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->