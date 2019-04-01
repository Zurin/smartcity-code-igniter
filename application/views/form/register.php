<div class="container">
            <div class="alert alert-success alert-dismissible fade collapse" id="notif_sukses" role="alert">
              <strong>Registrasi berhasil!</strong> Silakan login untuk menggunakan akun Anda.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="alert alert-danger alert-dismissible fade collapse" id="notif_gagal" role="alert">
              <strong>Registrasi gagal!</strong> Terjadi kesalahan.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
      <div class="row align-items-center">
        <div class="col-md-6 offset-md-3 col-sm-12 offset-sm-0">
          <div class="card card-block" style="margin-top: 5%;">
            <div class="card-body">
              <h4 class="card-title text-center"><i class="fa fa-user"></i> Register</h4>
              <hr class="my-4">
              <form method="post" id="register">
                <span class="form-text">
                  <a href="<?php echo base_url(); ?>index.php/auth/login">Sudah punya akun? Login di sini.</a>
                </span>
                <div class="form-group">
                  <label for="username">Nama Lengkap</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                       <i class="fa fa-user-o"></i>
                     </div>
                      <input type="text" name="nama" class="form-control required" id="nama" placeholder="Masukkan nama lengkap Anda">
                  </div>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                       <i class="fa fa-user"></i>
                     </div>
                      <input type="text" name="username" class="form-control required" id="username" placeholder="Masukkan username">
                      <div class="invalid-feedback">
                        Username sudah digunakan
                     </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="email">E-mail</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                       <i class="fa fa-envelope"></i>
                     </div>
                     <input type="email" name="email" class="form-control required" id="email" placeholder="Masukkan e-mail">
                     <div class="invalid-feedback">
                      Format e-mail salah
                     </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                       <i class="fa fa-lock"></i>
                     </div>
                      <input type="password" name="password" class="form-control required" id="password" placeholder="Masukkan password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password2">Konfirmasi Password</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                       <i class="fa fa-lock"></i>
                     </div>
                     <input type="password" name="password2" class="form-control required" id="password2" placeholder="Masukkan konfirmasi password">
                     <div class="invalid-feedback">
                      Password tidak cocok
                     </div>
                  </div>
                </div>
                <label for="password2">Gender</label>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="l" checked>Laki-laki
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="gender" id="gender" value="p">Perempuan
                  </label>
                </div>
                <div class="form-group">
                  <label for="tgl_lahir">Tanggal lahir</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                       <i class="fa fa-calendar"></i>
                     </div>
                     <input type="text" name="tgl_lahir" class="form-control required" id="tgl_lahir" placeholder="Tanggal lahir">
                  </div>
                </div>
                <button type="submit" id="registerButton" class="btn btn-info">Register</button>
                <button type="reset" class="btn btn-danger">Batal</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>