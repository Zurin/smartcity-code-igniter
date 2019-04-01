    <script>    
      
      function initMap(){
        var geocoder = new google.maps.Geocoder;
        infoWindow = new google.maps.InfoWindow;
        $('#nav-tab-img a').on('shown.bs.tab', function (e) {
                google.maps.event.trigger($('#street_report')[0], 'resize');
                google.maps.event.trigger(panorama, "resize");
        });
        $('#street_report').each(function(){
                  panorama = new google.maps.StreetViewPanorama(
                  document.getElementById('street_report'), {
                    position: {lat: <?php echo $data_report[0]->latitude; ?>, lng: <?php echo $data_report[0]->longitude; ?>},
                    pov: {heading: 165, pitch: 0},
                    visible: true,
                    zoom: 0
                  });
        });
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

    </script>
<div class="card">
    <div class="card-header">
        <img src="<?php echo base_url(); ?>assets/themes/front/img/marker/<?php echo $data_report[0]->icon; ?>" alt="icon kategori" class="img-responsive">
        <?php echo $data_report[0]->nama_kejadian."-".$data_report[0]->nama_sub_kejadian; ?>
    </div>
    <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <nav>
              <div class="nav nav-tabs" id="nav-tab-img" role="tablist">
                <a class="nav-item nav-link active" id="nav-foto-tab" data-toggle="tab" href="#nav-foto" role="tab" aria-controls="nav-foto" aria-selected="true">Foto</a>
                <a class="nav-item nav-link" id="nav-street-tab" data-toggle="tab" href="#nav-street" role="tab" aria-controls="nav-street" aria-selected="false">Street View</a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-foto" role="tabpanel" aria-labelledby="nav-foto-tab">
                <img id="foto_report" src="<?php echo base_url(); ?>assets/themes/front/img/photos/<?php echo $data_report[0]->foto; ?>" class="img-fluid" alt="Image" style="width:100%">
              </div>
              <div class="tab-pane fade" id="nav-street" role="tabpanel" aria-labelledby="nav-profile-street">
                <!-- <img id="street_report" src="" class="img-fluid" alt="Street" style="width: 100%"> -->
                <div id="street_report" style="position: absolute; background-color: transparent; overflow: visible; height:55%; width: 90%; max-height:60%; display: block"></div>
                <br><br><br><br><br><br><br><br><br><br><br><br>    
                <!-- <small class="text-muted">
                  Please enter full screen first to view
                </small> -->
              </div>
            </div>
            <br><br>
            <?php if($user!==NULL): ?>
              <div class="fav-container">
                <!-- bintang fav disini -->
                <?php
                    $this->load->model('db_model');
                    $get_fav= $this->db_model->get_where2('tb_favorite', 'id_post', 'id_user', $data_report[0]->id_post, $user['id_user']);
                    if (count($get_fav)>0):
                ?>
                    <a href="" onclick="unFav(<?php echo $user['id_user']; ?>, <?php echo $data_report[0]->id_post; ?>)"><i class="fa fa-star fa-2x text-warning"></i></a>
                <?php else: ?>
                    <a href="" onclick="addFav(<?php echo $user['id_user']; ?>, <?php echo $data_report[0]->id_post; ?>)"><i class="fa fa-star-o fa-2x text-warning"></i></a>
                <?php endif ?>
              </div>
            <?php endif ?>
            <hr align="center" style="max-width: 100%;">
            <h6>Share:</h6>
            <!-- AddToAny BEGIN -->
            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
              <a class="a2a_button_facebook"></a>
              <a class="a2a_button_twitter"></a>
              <a class="a2a_button_google_plus"></a>
              <a class="a2a_button_whatsapp"></a>
            </div>
            <script>
              var a2a_config = a2a_config || {};
              a2a_config.num_services = 4;
            </script>
            <script async src="https://static.addtoany.com/menu/page.js"></script>
            <!-- AddToAny END -->
          </div>
          <div class="col-md-6">
            <div class="row">
                  <div class="col-md-2 text-left">
                    <h5><span class="badge badge-info"><small><i class="fa fa-info"></i> Status</small></span></h5>
                  </div>
                  <div class="col-md-8 text-center">
                    <small class="text-muted">Klik untuk melihat detail status</small>
                  </div>
                  <div class="col-md-2 text-right" id="status_report">
                    <?php if($data_report[0]->status == 'waiting'): ?>
                        <a href="#" id="waiting_status" style=" text-decoration:none;" data-toggle="popover" data-html="true" data-placement="bottom" title="<div class='text-danger'>Status: waiting</div>">
                            <i class="fa fa-circle text-danger"></i>
                        </a>
                    <?php elseif($data_report[0]->status == 'process'): ?>
                        <a href="#" id="process_status" style="text-decoration:  none;" data-toggle="popover" data-html="true" data-placement="bottom" title="<div class='text-warning'>Status: on-process</div>" data-content="<?php echo $data_report[0]->keterangan; ?> <br> Ditangani oleh: <?php echo $data_report[0]->ditangani_oleh; ?><br> <small class='text-muted'><?php echo $data_report[0]->tgl_status; ?></small>">
                            <i class="fa fa-circle text-warning"></i>
                        </a>
                    <?php else: ?>
                        <a href="#" id="completed_status" style="text-decoration:  none;" data-toggle="popover" data-html="true" data-placement="bottom" title="<div class='text-success'>Status: completed</div>" data-content="<?php echo $data_report[0]->keterangan; ?> <br> Ditangani oleh: <?php echo $data_report[0]->ditangani_oleh; ?><br> <small class='text-muted'><?php echo $data_report[0]->tgl_status; ?></small>">
                            <i class="fa fa-circle text-success"></i>
                        </a>
                    <?php endif ?>
                  </div>
            </div>
            <strong class="text-warning" id="nama_user"><?php echo $data_report[0]->nama; ?></strong> <br>
            <small class="text-muted" id="date_post"><i class="fa fa-calendar"></i> <?php echo date("d M Y H:i A", strtotime($data_report[0]->tgl_post)); ?> </small>
            <hr align="center" style="max-width: 100%;">
              <h5><span class="badge badge-success"><small><i class="fa fa-map-marker"></i> Detail lokasi</small></span></h5>
              <small class="text-muted" id="location_detail"><?php echo $data_report[0]->lokasi; ?></small>
            <hr align="center" style="max-width: 100%;">
            <h6 align="justify" id="deskripsi_report">
                <?php 
                    $deskripsi_quote = str_replace('"','&quot;', $data_report[0]->deskripsi);
                    $deskripsi = preg_replace("/[\n\r]/","<br/>", $deskripsi_quote);
                    echo $deskripsi;
                ?>
            </h6>
            <hr align="center" style="max-width: 100%; border-color:#dfdfdf">
            <!-- <h5><span class="badge badge-info"><i class="fa fa-comment-o"></i> Comments</span></h5> -->
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Tulis Komentar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Komentar</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="notif-komen">
                        
                    </div>
                    <?php if($user!==NULL): ?>
                    <form class="" id="formKomentar" action="#" method="post">
                        <div class="form-group">
                        <input type="hidden" name="id_post" id="id_post" value="<?php echo $data_report[0]->id_post; ?>">
                        <label for="isi">Komentar</label>
                        <textarea class="form-control required" id="isi_komentar" name="isi_komentar" rows="3" placeholder="Isi komentar Anda"></textarea>
                        </div>
                        <button type="submit" id="submitKomentar" class="btn btn-primary">Kirim</button>
                    </form>
                    <?php else: ?>
                    <p class="text-muted">Silakan login untuk dapat mengirim komentar.</p>
                    <?php endif ?>
                </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="comments">
                  <!-- <p id="comments-loader" class="text-muted text-center">
                    <i class='fa fa-spinner fa-spin'></i> Memuat komentar
                  </p> -->
                  <div class="comments-container">
                    <?php 
                     $komentar = $this->db_model->get_komentar_report($data_report[0]->id_post);                     
                    ?>
                     <?php if(count($komentar) > 0): ?>
                        <?php foreach ($komentar as $key => $value): ?>
                         <div class="card">
                            <div class="card-header bg-secondary">
                                <small class="text-white"><?php echo $value->nama; ?></small>
                                <small class="text-white pull-right"><i class="fa fa-calendar"></i> <?php echo date("d M Y H:i A", strtotime($value->tgl_komentar)); ?> </small></div>
                                <div class="card-body">
                                    <p class="card-text" align="justify"><small><?php echo $value->isi_komentar; ?></small></p>
                                </div>
                            </div><br>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted text-center">Belum ada komentar pada report ini.</p>
                    <?php endif; ?>
                  </div>
                </div>
                <br>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>