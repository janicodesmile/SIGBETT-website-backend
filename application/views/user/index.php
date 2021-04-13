         <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $judul?></h1>

          <table class="table table-borderless table-dark">
          <thead>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><?= $user['nama_depan'] .' ' . $user['nama_belakang'] ?></td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td><?= $user['email'] ?></td>
            </tr>
            <tr>
              <td>tnggl pembuatan akun</td>
              <td>:</td>
              <td><?= date('d F Y', $user['date_create']);?></td>
            </tr>
          <img class="img-profile rounded-circle" height="200" width="200" src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>">  
          </tbody>
        </table>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->