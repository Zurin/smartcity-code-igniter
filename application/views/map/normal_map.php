<div id="map"></div>
    <script>
      var map, InfoWindow, panorama;
      var style_day = [{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text","stylers":[{"visibility":"off"},{"saturation":"-40"},{"lightness":"-46"},{"weight":"0.01"}]},{"featureType":"administrative.neighborhood","elementType":"labels.icon","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape.man_made","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural.landcover","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural.terrain","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.government","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.line","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"transit.station.bus","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"labels.text","stylers":[{"visibility":"off"}]}
      ];
      var style_night = [
        {"featureType":"all","elementType":"all","stylers":[{"invert_lightness":true},{"saturation":10},{"lightness":30},{"gamma":0.5},{"hue":"#435158"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"administrative.province","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text","stylers":[{"visibility":"off"},{"saturation":"-40"},{"lightness":"-46"},{"weight":"0.01"}]},{"featureType":"administrative.neighborhood","elementType":"labels.icon","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape.man_made","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural.landcover","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural.terrain","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.government","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.line","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"transit.station.bus","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"labels.text","stylers":[{"visibility":"off"}]}
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
          maxZoom: 18,
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

        var geocoder = new google.maps.Geocoder;
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            $("#addModal").on("shown.bs.modal", function () {
              google.maps.event.trigger($('#picker')[0], 'resize');
              $('#picker').locationpicker('location',{latitude:position.coords.latitude,longitude:position.coords.longitude});
            });
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            map.setCenter(pos);
            map.setZoom(14);            
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

        var iconBase = '<?php echo base_url(); ?>assets/themes/front/img/marker/';
        var icons = {
          <?php foreach ($kejadian as $key => $value) { ?>
          <?php echo $value->id_kejadian ?>: {
            icon: iconBase + '<?php echo $value->icon; ?>'
          },
          <?php } ?>
        };

        // var features = [
        //   {
        //     position: new google.maps.LatLng(-33.91721, 151.22630),
        //     type: 'alert'
        //   }, 
        // ];

        // Create markers.
        // features.forEach(function(feature) {
        var markers = [];
        <?php foreach ($lokasi as $key => $value) {?>
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo $value->latitude; ?>, <?php echo $value->longitude; ?>),
            icon: icons[<?php echo $value->id_kejadian; ?>].icon,
            map: map
          });

          var getlatlng = {lat: <?php echo $value->latitude; ?>, lng: <?php echo $value->longitude; ?>};
            geocoder.geocode({'location': getlatlng}, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                  $('#btn-lokasi-<?php echo $value->id_post; ?>').attr('data-content', results[0].formatted_address);
                } else {
                  $('#btn-lokasi-<?php echo $value->id_post; ?>').attr('data-content', 'Lokasi tidak ditemukan');
                }
              } else {
                $('#btn-lokasi-<?php echo $value->id_post; ?>').attr('data-content', 'Geocoder gagal karena masalah: '+status);
              }
          });

          google.maps.event.addListener(marker, 'click', function() {
            $('#street_report').each(function(){
                  panorama = new google.maps.StreetViewPanorama(
                  document.getElementById('street_report'), {
                    position: {lat: <?php echo $value->latitude; ?>, lng: <?php echo $value->longitude; ?>},
                    pov: {heading: 165, pitch: 0},
                    visible: true,
                    zoom: 0
                  });
            });
            map.setStreetView(panorama);
            panorama.setVisible(true);
            <?php if($user != NULL): ?>
              checkFav(<?php echo $user['id_user']; ?>, <?php echo $value->id_post; ?>);
            <?php endif ?>
            refreshKomentar(<?php echo $value->id_post; ?>);
            $('#mapModal').modal('show');  
            $("#mapModal").on("shown.bs.modal", function () {
                google.maps.event.trigger($('#street_report')[0], 'resize');
                google.maps.event.trigger(panorama, "resize");
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                google.maps.event.trigger($('#street_report')[0], 'resize');
                google.maps.event.trigger(panorama, "resize");
            })
            $('.header_modal').empty();
            $('.header_modal').append('<?php echo $value->nama_kejadian."-".$value->nama_sub_kejadian; ?>');
            $('#nama_user').empty();
            $('#nama_user').append('<?php echo $value->nama; ?>');
            $('#date_post').empty();
            <?php $date = date("d M Y H:i A", strtotime($value->tgl_post)); ?>
            $('#date_post').append('<?php echo $date; ?>');
            $('#process_status').addClass('d-none');
            $('#waiting_status').addClass('d-none');
            $('#completed_status').addClass('d-none');
            $('#process_status').removeAttr('data-content');
            $('#completed_status').removeAttr('data-content');
            <?php if($value->status == 'waiting'){ ?>
                $('#waiting_status').removeClass('d-none');
            <?php } else if($value->status == 'process') { ?>
                $('#process_status').removeClass('d-none');
                $('#process_status').attr('data-content', '<?php echo $value->keterangan; ?> <br> Ditangani oleh: <?php echo $value->ditangani_oleh; ?><br> <small class="text-muted"><?php echo $value->tgl_status; ?></small>');
            <?php } else { ?>
                $('#completed_status').removeClass('d-none');
                $('#completed_status').attr('data-content', '<?php echo $value->keterangan; ?> <br> Ditangani oleh: <?php echo $value->ditangani_oleh; ?><br> <small class="text-muted"><?php echo $value->tgl_status; ?></small>');
            <?php } ?>
            $('#deskripsi_report').empty();
            <?php 
              $deskripsi_quote = str_replace('"','&quot;', $value->deskripsi);
              $deskripsi = preg_replace("/[\n\r]/","<br/>", $deskripsi_quote);
            ?>
            $('#deskripsi_report').append("<?php echo $deskripsi; ?>");
            $('#icon_report').removeAttr('src');
            $('#icon_report').attr('src', icons[<?php echo $value->id_kejadian; ?>].icon);
            $('#foto_report').removeAttr('src');
            $('#foto_report').attr('src', '<?php echo base_url(); ?>assets/themes/front/img/photos/<?php echo $value->foto; ?>');
            // $('#street_report').removeAttr('src');
            // $('#street_report').attr('src', 'https://maps.googleapis.com/maps/api/streetview?size=600x300&location=<?php echo $value->latitude; ?>,<?php echo $value->longitude; ?>&heading=151.78&pitch=-0.76&key=AIzaSyD9dF4USe_uzgeUKcfjgqLezbEh6fW6KtU');
            $('#location_detail').empty();
            
            $('#id_post').val('<?php echo $value->id_post; ?>');

            var latlng = {lat: <?php echo $value->latitude; ?>, lng: <?php echo $value->longitude; ?>};
            geocoder.geocode({'location': latlng}, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                  // infowindow.setContent(results[0].formatted_address);
                  $('#location_detail').append(results[0].formatted_address);
                } else {
                  $('#location_detail').append('Lokasi tidak ditemukan');
                }
              } else {
                $('#location_detail').append('Geocoder gagal karena masalah: '+status);
              }
            });
            
            // $('.comments-container').empty();
            // var komentar = "";
            // <?php 
            //   $this->load->model('db_model');
            //   $komentar = $this->db_model->get_komentar_report($value->id_post);
            //   foreach ($komentar as $key => $value):
            // ?>
            //     komentar += '<div class="card"><div class="card-header bg-secondary"><small class="text-white"><?php //echo $value->nama; ?></small><small class="text-white pull-right"><i class="fa fa-calendar"></i> <?php //echo date("d M Y H:i A", strtotime($value->tgl_komentar)); ?> </small></div><div class="card-body"><p class="card-text" align="justify"><small><?php //echo $value->isi_komentar; ?></small></p></div></div><br>';
            // <?php //endforeach; ?>
            // <?php //if(count($komentar) > 0): ?>
            //     $('.comments-container').append(komentar);
            // <?php //else: ?>
            //     $('.comments-container').append('<p class="text-muted text-center">Belum ada komentar pada report ini.</p>');
            // <?php //endif; ?>
            
          });

          markers.push(marker);
        <?php } ?>
        // });
        var clusterOptions = {
            imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
            maxZoom: 12
        };
        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers, clusterOptions);

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };


            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
          var listener = google.maps.event.addListener(map, "idle", function() {
            if (map.getZoom() < 17) map.setZoom(17);
            google.maps.event.removeListener(listener);
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