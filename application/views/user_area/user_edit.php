<div class="notif">
  <!-- <div class="alert alert-danger alert-dismissible fade collapse show" id="notif_gagal" role="alert"><strong>Gagal!</strong> Foto gagal diupload.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div> -->
</div>
<div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <div class="card">
                <?php if($data_user[0]->avatar==NULL): ?>
                    <img class="card-img-top" id="preview" src="<?php echo base_url(); ?>assets/themes/front/img/photo_dummy.jpg">
                <?php else: ?>
                    <img class="card-img-top" id="preview" src="<?php echo base_url(); ?>assets/themes/front/img/avatar/<?php echo $data_user[0]->avatar; ?>">
                <?php endif ?>
                <div class="card-body">
                  <form action="#" method="post" id="formAvatar">
                    <div class="form-group">
                      <label class="custom-file">
                        <input type="file" name="avatar" id="avatar" class="form-control required">
                      </label>
                    </div>
                    <button class="btn btn-danger btn-block" type="submit" id="submitAvatar" name="avatar">Ganti Foto Avatar</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-12">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/map">Map</a></li>
                      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/user">Profil Pengguna</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                    </ol>
                  </nav>
                </div>
                <div class="col-md-6">
                  <h4 class="card-title"><i class="fa fa-user"></i> General</h4>
                  <hr>
                  <form method="post" action="#" id="formPassword">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username Anda" value="<?php echo $data_user[0]->username; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password_lama">Password lama</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-lock"></i>
                        </div>
                        <input type="password" name="password_lama" class="form-control required" id="password_lama" placeholder="Masukkan password lama">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password_lama">Password baru</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-lock"></i>
                        </div>
                        <input type="password" name="password_baru" class="form-control required" id="password_baru" placeholder="Masukkan password baru">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password_baru2">Konfirmasi password baru</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-lock"></i>
                        </div>
                        <input type="password" name="password_baru2" class="form-control required" id="password_baru2" placeholder="Konfirmasi password baru">
                      </div>
                    </div>
                    <button type="submit" id="submitPassword" class="btn btn-info btn-block">Ubah Password</button>
                  </form>
                </div>
                <div class="col-md-6">
                  <h4 class="card-title"> Data Pribadi</h4>
                  <hr>
                  <form method="post" action="" id="formGeneral">
                    <div class="form-group">
                      <label for="username">Nama lengkap</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user-o"></i>
                        </div>
                          <input type="text" name="nama" class="form-control required" id="nama" placeholder="Masukkan nama lengkap Anda" value="<?php echo $data_user[0]->nama; ?>">
                      </div>
                    </div>
                    <label for="password2">Gender</label>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="l" <?php if($data_user[0]->gender=='l') echo "checked"?>>Laki-laki
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="p" <?php if($data_user[0]->gender=='p') echo "checked"?>>Perempuan
                      </label>
                    </div>
                    <div class="form-group">
                      <label for="tgl_lahir">Tanggal lahir</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="tgl_lahir" class="form-control required" id="tgl_lahir" placeholder="Tanggal lahir" value="<?php echo date("d-m-Y", strtotime($data_user[0]->tgl_lahir)); ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">E-mail</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-envelope"></i>
                        </div>
                          <input type="text" name="email" class="form-control required" id="email" placeholder="Masukkan e-mail lengkap Anda" value="<?php echo $data_user[0]->email; ?>">
                      </div>
                    </div>
                    <button type="submit" id="submitGeneral" class="btn btn-success btn-block">Simpan perubahan</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>