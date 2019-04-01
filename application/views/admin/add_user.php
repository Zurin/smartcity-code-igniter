<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tambah User Baru</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>                            
                        </div>
                    </div>
                    <div class="ibox-content">
                        
                        <div class="row">
                            <form action="" id="formAddUser">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Username</label>
                                        <div class="form-group" id="usernameControl">
                                            <input type="text" class="form-control required" name="username" id="usernameA" placeholder="Masukkan username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nama user</label>
                                        <input type="text" class="form-control required" name="nama" id="namaA" placeholder="Masukkan nama user">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Gender</label>
                                        <div class="i-checks-green"><label> <input type="radio" checked="checked" value="l" name="gender"> <i></i> Laki-laki </label></div>
                                        <div class="i-checks-green"><label> <input type="radio" value="p" name="gender"> <i></i> Perempuan </label> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tanggal lahir</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control required" name="tgl_lahir" id="tgl_lahir" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">E-mail</label>
                                        <div class="form-group" id="emailControl">
                                            <input type="email" class="form-control required" name="email" id="emailA" placeholder="Masukkan e-mail aktif user">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <div class="form-group" id="passwordControl">
                                            <input type="password" class="form-control required" name="password" id="password" placeholder="Masukkan password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Konfirmasi Password</label>
                                        <div class="form-group" id="passwordControl2">
                                            <input type="password" class="form-control required" name="password2" id="password2" placeholder="Konfirmasi password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Level user</label>
                                        <div class="i-checks-green"><label> <input type="radio" checked="checked" value="member" name="levelA"> <i></i> Member </label></div>
                                        <div class="i-checks-green"><label> <input type="radio" value="admin" name="levelA"> <i></i> Admin </label> </div>
                                        <div class="i-checks-green"><label> <input type="radio" value="adminRS" name="levelA"> <i></i> Admin RS </label> </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" id="submitAddUser" class="btn btn-primary">Daftarkan</button>
                                        <button type="reset" class="btn btn-danger">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
        </div>
    </div>
</div>
