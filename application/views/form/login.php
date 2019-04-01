<div class="container">
            <div class="notif"></div>
      <div class="row align-items-center">
        <div class="col-md-6 offset-md-3 col-sm-12 offset-sm-0">
          <div class="card card-block" style="margin-top: 25%;">
            <div class="card-body">
              <h4 class="card-title text-center"><i class="fa fa-sign-in"></i> Login Smart City</h4>
              <hr class="my-4">
              <form method="post" action="" id="login">
                <span class="form-text">
                  <a href="<?php echo base_url(); ?>index.php/auth/register">Belum punya akun? Daftar di sini.</a>
                </span>
                <div class="form-group">
                  <label for="email">E-mail atau Username</label>
                  <div class="input-group">
                     <div class="input-group-addon">
                       <i class="fa fa-user"></i>
                     </div>
                     <input type="text" name="username" class="form-control required" id="username" placeholder="Masukkan username">
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
                <button type="submit" id="loginButton" class="btn btn-info">Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>