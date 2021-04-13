  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buat akun baru</h1>
              </div>
              <form class="user" method="post" action="<?= base_url('auth/daftar') ?>">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="namaDepan" name="namaDepan" placeholder="Nama Depan" value="<?= set_value('namaDepan') ?>">
                      <?= form_error('namaDepan','<small class="text-danger">','</small>'); ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="namaBelakang" name="namaBelakang" placeholder="Nama Belakang" value="<?= set_value('namaBelakang') ?>">
                    <?= form_error('namaBelakang','<small class="text-danger">','</small>'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email') ?>">
                  <?= form_error('email','<small class="text-danger">','</small>'); ?>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    <?= form_error('password','<small class="text-danger">','</small>'); ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= base_url(); ?>Auth/">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>