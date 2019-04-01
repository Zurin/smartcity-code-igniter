<div id="map"></div>
<script>
    var map, InfoWindow, panorama;
      var style_day = [
        {"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}
      ];
      var style_night = [
        {"featureType":"all","elementType":"all","stylers":[{"invert_lightness":true},{"saturation":10},{"lightness":30},{"gamma":0.5},{"hue":"#435158"}]}
      ];
      
      var hr = (new Date()).getHours();
      if (hr >= 6 && hr < 18) {
        mapStyle = style_day;
      } else {
        mapStyle = style_night;
      }

    function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: new google.maps.LatLng(-1.878514, 115.321239),
            styles: mapStyle,
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            mapTypeControl: false,
            fullscreenControl: false,
            mapTypeId: 'roadmap'
            });

            infoWindow = new google.maps.InfoWindow;

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                $('#picker').locationpicker('location',{latitude:position.coords.latitude,longitude:position.coords.longitude});
                var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
                };
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
            } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
            }

            var geocoder = new google.maps.Geocoder;
    }
</script>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tambah Layanan Kesehatan Publik Baru</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>                            
                        </div>
                    </div>
                    <div class="ibox-content">                        
                        <div class="row">
                            <form action="" id="formAddLayanan" enctype="multipart/form-data">
                                <div class="col-sm-6">
                                    <img id="preview" src="<?php echo base_url(); ?>assets/themes/front/img/preview-icon.png" alt="Preview" style="max-width: 50%">    
                                    <div class="form-group">
                                        <label class="control-label">Foto</label>
                                        <div class="form-group" id="fotoControl">
                                            <input type="file" name="foto" class="form-control-file required" id="foto">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Deskripsi</label>
                                        <textarea rows="6" class="form-control required" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi layanan kesehatan publik"></textarea>
                                    </div>                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Lokasi</label>
                                        <div class="form-group" id="lokasiControl">
                                            <input type="text" class="form-control required" name="lokasi" id="picker-address">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Latitude</label>
                                                <div class="form-group" id="latitudeControl">
                                                    <input type="text" class="form-control required" name="latitude" id="picker-lat" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Longitude</label>
                                                <div class="form-group" id="longitudeControl">
                                                    <input type="text" class="form-control required" name="longitude" id="picker-long" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($user['level']=='adminRS'): ?>
                                        <input type="hidden" name="id_user" id="id_user" value="<?php echo $user['id_user']; ?>">
                                    <?php else: ?>
                                        <div class="form-group">
                                            <label class="control-label">Admin RS</label>
                                            <select class="form-control m-b" name="id_user" id="id_user">
                                                <?php foreach ($admin_rs as $key => $value): ?>
                                                    <option value="<?php echo $value->id_user; ?>"><?php echo $value->username." (".$value->nama.")"; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    <?php endif ?>
                                    <br>
                                    <div id="picker" style="width: 100%; height: 320px;"></div>
                                    <br>
                                    <div class="form-group">
                                        <button type="submit" id="submitAddLayanan" class="btn btn-primary">Tambah Layanan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
        </div>
    </div>
</div>
