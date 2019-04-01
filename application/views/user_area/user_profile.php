<div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <div class="card">
                <?php if($data_user[0]->avatar==NULL): ?>
                <img class="card-img-top" src="<?php echo base_url(); ?>assets/themes/front/img/photo_dummy.jpg">
                <?php else: ?>
                <img class="card-img-top" src="<?php echo base_url(); ?>assets/themes/front/img/avatar/<?php echo $data_user[0]->avatar; ?>">
                <?php endif ?>
                <div class="card-body">
                  <h4 class="card-title text-center"><?php echo strtoupper($data_user[0]->username); ?></h4>
                  <a href="<?php echo base_url(); ?>index.php/user/edit" class="btn btn-primary btn-block">
                    <i class="fa fa-pencil"></i> Edit Profile
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/map">Map</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Profil Pengguna</li>
                </ol>
              </nav>
              <h4 class="card-title"><i class="fa fa-user"></i> Data Pribadi</h4>
              <hr>
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th>Nama lengkap</th>
                    <td>
                        <?php echo $data_user[0]->nama; ?>
                    </td>
                  </tr>
                  <tr>
                    <th>Tanggal lahir</th>
                    <td>
                        <?php echo date("d-m-Y", strtotime($data_user[0]->tgl_lahir)); ?>
                    </td>
                  </tr>
                  <tr>
                    <th>Gender</th>
                    <td>
                        <?php ($data_user[0]->gender=='l') ? $jk = "Laki-laki" : $jk = "Perempuan";  ?>
                        <?php echo $jk; ?>
                    </td>
                  </tr>
                  <tr>
                    <th>E-mail</th>
                    <td>
                        <?php echo $data_user[0]->email; ?>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-md-9 offset-md-3">
              <!-- <h4 class="card-title"></h4> -->
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-lap-tab" data-toggle="tab" href="#nav-lap" role="tab" aria-controls="nav-lap" aria-selected="true"><i class="fa fa-book"></i> Laporan</a>
                  <a class="nav-item nav-link" id="nav-fav-tab" data-toggle="tab" href="#nav-fav" role="tab" aria-controls="nav-fav" aria-selected="false"><i class="fa fa-star"></i> Favorite</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-lap" role="tabpanel" aria-labelledby="nav-lap-tab">
                  <hr>
                  <?php if(count($data_lap_user)==0): ?>
                    <h7 class="text-muted">Anda belum melaporkan apapun</h7>
                  <?php else: ?>
                    <div class="card-columns">
                        <?php foreach ($data_lap_user as $key => $value): ?>
                            <div class="card">
                                <img class="card-img-top" src="<?php echo base_url(); ?>assets/themes/front/img/photos/<?php echo $value->foto; ?>" alt="Foto">
                                <div class="card-body">
                                <p class="card-text text-justify">
                                    <small>
                                    <?php 
                                        echo substr($value->deskripsi, 0, 120); 
                                        echo strlen($value->deskripsi) > 120 ? "...." : "";
                                    ?>
                                    </small>
                                </p>
                                <p class="card-text"><small class="text-muted">
                                    <?php echo date("d M Y H:i A", strtotime($value->tgl_post)); ?>
                                </small></p>
                                <a href="<?php echo base_url(); ?>index.php/user/report_detail/<?php echo $value->id_post; ?>" class="btn btn-sm btn-danger btn-block">
                                  <i class="fa fa-plus-square"></i> Selengkapnya
                                </a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                  <?php endif ?>
                </div>
                <div class="tab-pane fade" id="nav-fav" role="tabpanel" aria-labelledby="nav-fav-tab">
                    <hr>
                    <?php if(count($data_fav)==0): ?>
                      <h7 class="text-muted">Anda belum memiliki laporan yang di favorite</h7>
                    <?php else: ?>
                      <div class="card-columns">
                          <?php foreach ($data_fav as $key => $value): ?>
                              <div class="card">
                                  <img class="card-img-top" src="<?php echo base_url(); ?>assets/themes/front/img/photos/<?php echo $value->foto; ?>" alt="Foto">
                                  <div class="card-body">
                                  <p class="card-text text-justify">
                                      <small>
                                      <?php 
                                          echo substr($value->deskripsi, 0, 120); 
                                          echo strlen($value->deskripsi) > 120 ? "...." : "";
                                      ?>
                                      </small>
                                  </p>
                                  <p class="card-text"><small class="text-muted">
                                      <?php echo date("d M Y H:i A", strtotime($value->tgl_post)); ?>
                                  </small></p>
                                  <a href="<?php echo base_url(); ?>index.php/user/report_detail/<?php echo $value->id_post; ?>" class="btn btn-sm btn-danger btn-block">
                                    <i class="fa fa-plus-square"></i> Selengkapnya
                                  </a>
                                  </div>
                              </div>
                          <?php endforeach ?>
                      </div>
                    <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>