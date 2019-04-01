<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $judul[0]->judul_web." - ".$halaman; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/themes/front/img/brand/<?php echo $judul[0]->favicon; ?>"/>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/themes/front/img/brand/<?php echo $judul[0]->favicon; ?>">
    <?php
        /** -- Copy from here -- */
        if(!empty($meta))
        foreach($meta as $name=>$content){
        echo "\n\t\t";
        ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
            }
        echo "\n";

        if(!empty($canonical))
        {
        echo "\n\t\t";
        ?><link rel="canonical" href="<?php echo $canonical?>" /><?php

        }
        echo "\n\t";

        foreach($css as $file){
        echo "\n\t\t";
        ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        } echo "\n\t";

        /** -- to here -- */
    ?>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* #street_report{
        height: 100%;
        width: 100%;
      } */
      /* Optional: Makes the sample page fill the window. */
      html, body {
        font-family: Roboto;
        height: 100%;
        margin: 0;
        padding: 0;
        margin-bottom: 0;
      }

      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }

      #pac-input {
        font-family: Roboto;
        margin-left: 35%;
        margin-top: 7%;
        width: 400px;
      }

      .pac-container{z-index:2000 !important;}

      @media only screen and (max-width: 991px) {
        #pac-input {
          font-family: Roboto;
          margin-left: 30%;
          margin-top: 15%;
          width: 350px;
        }
      }

      @media only screen and (max-width: 720px) {
        #pac-input {
          font-family: Roboto;
          margin-left: 27%;
          margin-top: 15%;
          width: 300px;
        }
      }

      @media only screen and (max-width: 440px) {
        #pac-input {
          font-family: Roboto;
          margin-left: 20%;
          margin-top: 20%;
          width: 250px;
        }
      }

      @media only screen and (max-width: 330px) {
        #pac-input {
          font-family: Roboto;
          margin-left: 12.5%;
          margin-top: 35%;
          width: 250px;
        }
      }

      .dropdown-toggle::after {
          display:none
      }

      .btn{
        margin-left:10px;
        margin-top:10px;
        border-radius: 2px;
      }

      .dropdown-menu {
        min-width: 5rem;
        font-size: 0.8rem;
        margin-top: 0.5rem;
      }

      .dropdown-item {
          padding: 0 .5rem 0 .5rem;
      }

      .tab-content .card {
        margin-bottom: -14px;
      }

    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top text-white" id="mainNav" style="background-color: transparent">
      <div class="container" style="padding-right:14px; margin-right:14px">
        <!-- <a class="navbar-brand js-scroll-trigger" href="<?php echo base_url(); ?>index.php/landing">Smart City</a> -->
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <form class="form-inline my-2 my-lg-0">
            <input id="pac-input" class="form-control mr-sm-2 controls" type="search" placeholder="Search location" aria-label="Search" style="display:none">
          </form>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item" data-toggle="tooltip" data-placement="left" title="List view">
              <a class="nav-link btn btn-primary" data-toggle="collapse" href="#collapseContainer" role="button" aria-expanded="false" aria-controls="collapseContainer">
                <i class="fa fa-list-alt text-white"></i>
              </a>
            </li>
            <li class="nav-item" id="search_nav_1">
              <a class="nav-link btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Cari lokasi">
                <i class="fa fa-search text-white"></i>
              </a>
            </li>
            <li class="nav-item d-none" id="search_nav_2">
              <a class="nav-link btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Cari lokasi">
                <i class="fa fa-search text-white"></i>
              </a>
            </li>
            <li class="nav-item dropdown" data-toggle="tooltip" data-placement="left" title="Pilih jenis map">
              <a class="nav-link dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-map-o text-white"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal" onclick="getLocation()"><i class="fa fa-plus"></i> Add Report</a> -->
                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/map"><i class="fa fa-globe"></i> Normal Map</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/map/heat_map"><i class="fa fa-thermometer-three-quarters"></i> Heat Map</a>
              </div>
              </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="bottom" title="Buat laporan">
              <a class="nav-link btn btn-primary" <?php if($user==NULL){ ?> href="<?php echo base_url(); ?>index.php/auth/login" <?php } else { ?> data-toggle="modal" data-target="#addModal" <?php } ?>>
                <i class="fa fa-pencil text-white"></i>
              </a>
            </li>
            <?php if($user!=NULL) { ?>
            <li class="nav-item dropdown" data-toggle="tooltip" data-placement="right" title="Menu pengguna">
              <a class="nav-link dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- Hi, <?php //echo $user['username']; ?> -->
                <i class="fa fa-key text-white"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal" onclick="getLocation()"><i class="fa fa-plus"></i> Add Report</a> -->
                <span class="dropdown-item active"><i class="fa fa-user"></i> Hi, <?php echo $user['username']; ?></span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/user"><i class="fa fa-cog"></i> Profil</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out"></i> Log Out</a>
              </div>
            </li>
            <?php } else {?>
              <li class="nav-item dropdown" data-toggle="tooltip" data-placement="right" title="Menu pengguna">
                <a class="nav-link dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <!-- Hi, <?php //echo $user['username']; ?> -->
                  <i class="fa fa-key text-white"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal" onclick="getLocation()"><i class="fa fa-plus"></i> Add Report</a> -->
                  <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/auth/login"><i class="fa fa-sign-in"></i> Login</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/auth/register"><i class="fa fa-address-book"></i> Register</a>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>

    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

    <?php echo $output; ?>
    
    <div class="fixed-bottom" style="margin-bottom: 56px; max-height: 570px; overflow: auto;">
      <div class="collapse" id="collapseContainer">
        <div class="card" style="border: 0px;">
            <a class="text-white" style="text-decoration: none;" data-toggle="collapse" href="#collapseContainer" role="button" aria-expanded="false" aria-controls="collapseContainer">
              <div class="card-header bg-primary text-center" style="opacity: 0.8">
                  <i class="fa fa-lg fa-angle-double-down"></i>
              </div>
            </a>
            <div class="card-body">
              <table id="tableCollapse" class="table table-sm table-striped table-bordered" cellspacing="0" style="width:100%">
                      <thead class="thead-dark">
                        <tr>
                          <th width="5%">No</th>
                          <th width="10%">Tanggal</th>
                          <th width="20%">Kategori kejadian</th>
                          <th width="30%">Deskripsi</th>
                          <th width="10%">Foto</th>
                          <th width="20%">Lokasi</th>
                          <th width="5%">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $i = 1;
                          foreach ($list_view as $key => $value): 
                        ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                              <small class="text-muted">
                                <i class="fa fa-calendar"></i>
                                <?php echo date("d-M-Y H:i A", strtotime($value->tgl_post)); ?>
                              </small>
                            </td>
                            <td width="20%">
                              <small>
                                <?php echo $value->nama_kejadian; ?>
                              </small>
                            </td>
                            <td width="30%">
                                <p align="justify">
                                  <small class="text-info">
                                  <?php 
                                      echo substr($value->deskripsi, 0, 120); 
                                      echo strlen($value->deskripsi) > 120 ? '....' : '';
                                  ?>
                                  </small>
                                </p>
                            </td>
                            <td>
                                  <a data-fancybox="gallery" href="<?php echo base_url(); ?>assets/themes/front/img/photos/<?php echo $value->foto; ?>">
                                    <img class="img-responsive image-thumbnail" style="height:64px;" src="<?php echo base_url(); ?>assets/themes/front/img/photos/<?php echo $value->foto; ?>">
                                  </a>
                            </td>
                            <td width="20%">
                              <small class="text-primary">
                                <?php echo $value->lokasi; ?>
                              </small>
                            </td>
                            <td>
                              <?php $status = $value->status; ?>
                              <span class="badge <?php if($status=='waiting') echo 'badge-danger'; else if($status=='process') echo 'badge-warning'; else if($status=='completed') echo 'badge-primary'; ?>">
                                <?php echo $status; ?>
                              </span>
                            </td>
                          </tr>
                        <?php $i++; endforeach ?>
                      </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
    
    <nav class="navbar fixed-bottom navbar-expand-sm navbar-dark py-2" style="background-color: #00BCD4; opacity:0.8;">
      <a class="navbar-brand" href="#">
        <img src="<?php echo base_url(); ?>assets/themes/front/img/brand/<?php echo $judul[0]->brand; ?>" style="height: 30px;" class="d-inline-block align-top" alt="Brand logo">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapseBottom" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapseBottom">
        <ul class="navbar-nav mr-auto">
          <!-- <li class="nav-item">
            <a class="nav-link active" href="<?php //echo base_url(); ?>index.php/landing">Landing Page</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link active" href="#" data-toggle="modal" data-target="#aboutModal">About</a>
          </li>
          <?php foreach ($sosmed as $key => $value): ?>
            <li class="nav-item">
              <a class="nav-link active" href="<?php echo $value->url; ?>" target="_blank">
                <i class="<?php echo $value->fa_sosmed ?>"></i>
              </a>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </nav>

    <?php
        foreach($js as $file){
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";
    ?>
    <script type="text/javascript">
      var base_url = $("#base_url").val();

      $(function () {
        $('[data-toggle="popover"]').popover();
        $('[data-toggle="tooltip"]').tooltip();
      });

      $(document).ready(function () {

        var tableCollapse = $('#tableCollapse').DataTable({
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            "columnDefs": [
                { "type": "date-dd-MMM-yyyy", targets: 1 }
            ],
        });

        $("#search_nav_1").click(function(){
            // $("p").hide(100);
            $("#search_nav_2").removeClass("d-none");
            $("#search_nav_1").addClass("d-none");
            $("#pac-input").show(100);
        });
        $("#search_nav_2").click(function(){
            // $("p").show(100);
            $("#search_nav_2").addClass("d-none");
            $("#search_nav_1").removeClass("d-none");
            $("#pac-input").hide(100);
        });

        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }

        $("#foto").change(function() {
          readURL(this);
        });

        var submitButton = $("#btnReport").attr("disabled", true);
        $("#add input.required").change(function () {
            var valid = true;
            $.each($("#add input.required"), function (index, value) {
                if(!$(value).val()){
                  valid = false;
                }
            });
            if(valid){
                $(submitButton).attr("disabled", false);
            }
            else{
                $(submitButton).attr("disabled", true);
            }
        });
        $('.alert').alert();

        $("#kejadian").change(function(){
          var kejadian = $("#kejadian option:selected").val();
          $.ajax({
            url: "<?php echo base_url(); ?>" + "index.php/actions/get_sub_kejadian",
            data: "kejadian="+kejadian,
            cache: false,
            success: function(msg){
              //jika data sukses diambil dari server kita tampilkan
              //di <select id=kota>
              $("#sub_kejadian").html(msg);
            }
          });
        });

        $("#btnReport").on('click', function() {
                $("#btnReport").attr('disabled', 'disabled');
                $("#btnReport").empty();
                $("#btnReport").append("Memproses <i class='fa fa-circle-o-notch fa-spin'></i>");
                event.preventDefault();
                var form = $('#add')[0];
                var formData = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/actions/add_report",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 'ok')
                        {
                            $("#add")[0].reset();
                            $(".notif").append('<div class="alert alert-success alert-dismissible fade collapse show" id="notif_sukses" role="alert"><strong>Sukses!</strong> Report Anda berhasil disubmit.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $('#preview').attr('src', '<?php echo base_url(); ?>assets/themes/front/img/preview-icon.png');
                            $('#btnReport').removeAttr('disabled');
                            $("#btnReport").empty();
                            $("#btnReport").append('Submit');
                            setTimeout(function(){// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 3000);
                        } 
                        else if(response == 'upload fail'){
                            $(".notif").append('<div class="alert alert-danger alert-dismissible fade collapse show" id="notif_gagal" role="alert"><strong>Gagal!</strong> Foto gagal diupload.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $('#btnReport').removeAttr('disabled');
                            $("#btnReport").empty();
                            $("#btnReport").append('Submit');
                        }
                        else {
                            $(".notif").append('<div class="alert alert-danger alert-dismissible fade collapse show" id="notif_gagal" role="alert"><strong>Gagal!</strong> Report Anda gagal disubmit.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $('#btnReport').removeAttr('disabled');
                            $("#btnReport").empty();
                            $("#btnReport").append('Submit');
                        }
                    }
                });
        });

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

        $('#picker').locationpicker({
          location: {
            latitude: -6.1751,
            longitude: 106.8650
          },
          styles: mapStyle,
          zoom: 15,
          markerInCenter: false,
          enableAutocomplete: true,
          enableReverseGeocode: true,
          radius: 0,
          addressFormat: 'street_number',
          inputBinding: {
              latitudeInput: $('#picker-lat'),
              longitudeInput: $('#picker-long'),
              radiusInput: $('#picker-radius'),
              locationNameInput: $('#picker-address')
          },
          onchanged: function (currentLocation, radius, isMarkerDropped) {
              var addressComponents = $(this).locationpicker('map').location.addressComponents;
              console.log(currentLocation);  //latlon  
              updateControls(addressComponents); //Data
              }
          });

          function updateControls(addressComponents) {
            console.log(addressComponents);
          }

      });

    </script>
  </body>
</html>

<div class="modal fade bd-example-modal-lg" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          <img id="icon_report" src="" alt="">
        </h5>
        <div class="header_modal"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-foto-tab" data-toggle="tab" href="#nav-foto" role="tab" aria-controls="nav-foto" aria-selected="true">Foto</a>
                <a class="nav-item nav-link" id="nav-street-tab" data-toggle="tab" href="#nav-street" role="tab" aria-controls="nav-street" aria-selected="false">Street View</a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-foto" role="tabpanel" aria-labelledby="nav-foto-tab">
                <img id="foto_report" src="" class="img-fluid" alt="Image" style="width:100%">
              </div>
              <div class="tab-pane fade" id="nav-street" role="tabpanel" aria-labelledby="nav-profile-street">
                <!-- <img id="street_report" src="" class="img-fluid" alt="Street" style="width: 100%"> -->
                <div id="street_report" style="position: absolute; background-color: transparent; overflow: visible; height:40%; width: 90%; display: block"></div>
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
                    <a href="#" class="d-none" id="waiting_status" style=" text-decoration:none;" data-toggle="popover" data-html="true" data-placement="bottom" title="<div class='text-danger'>Status: waiting</div>">
                      <i class="fa fa-circle text-danger"></i>
                    </a>
                    <a href="#" class="d-none" id="process_status" style="text-decoration:  none;" data-toggle="popover" data-html="true" data-placement="bottom" title="<div class='text-warning'>Status: on-process</div>" data-content="">
                      <i class="fa fa-circle text-warning"></i>
                    </a>
                    <a href="#" class="d-none" id="completed_status" style="text-decoration:  none;" data-toggle="popover" data-html="true" data-placement="bottom" title="<div class='text-success'>Status: completed</div>" data-content="">
                      <i class="fa fa-circle text-success"></i>
                    </a>
                  </div>
            </div>
            <strong class="text-warning" id="nama_user"></strong> <br>
            <small class="text-muted" id="date_post"><i class="fa fa-calendar"></i>  </small>
            <hr align="center" style="max-width: 100%;">
              <h5><span class="badge badge-success"><small><i class="fa fa-map-marker"></i> Detail lokasi</small></span></h5>
              <small class="text-muted" id="location_detail"></small>
            <hr align="center" style="max-width: 100%;">
            <h6 align="justify" id="deskripsi_report">
              
            </h6>
            <hr align="center" style="max-width: 100%; border-color:#dfdfdf">
            <!-- <h5><span class="badge badge-info"><i class="fa fa-comment-o"></i> Comments</span></h5> -->
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Tulis Komentar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Komentar</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="notif-komen">
                    
                </div>
                <?php if($user!==NULL): ?>
                  <form class="" id="formKomentar" action="#" method="post">
                    <div class="form-group">
                      <input type="hidden" name="id_post" id="id_post">
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
                  <p id="comments-loader" class="text-muted text-center">
                    <i class='fa fa-spinner fa-spin'></i> Memuat komentar
                  </p>
                  <div class="comments-container">
                    
                  </div>
                </div>
                <br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="logoutModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-sign-out"></i> Konfirmasi Log Out</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin akan log out?</p>
      </div>
      <form action="<?php echo base_url(); ?>index.php/actions/logout">
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Ya</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" id="addModal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-plus-circle"></i> Formulir Penambahan Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" id="add" enctype="multipart/form-data">
      <div class="modal-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <img id="preview" src="<?php echo base_url(); ?>assets/themes/front/img/preview-icon.png" alt="Preview" style="max-width: 100%">
                    </div>
                    <div class="col-md-6">
                      <label for="foto">Foto</label>
                      <input type="file" name="foto" class="form-control-file required" id="foto">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <textarea class="form-control required" name="deskripsi" id="deskripsi" rows="4" placeholder="Masukkan deskripsi report"></textarea>
                </div>
                <div class="form-group">
                  <label for="picker-address">Lokasi</label>
                  <input type="text" class="form-control required" name="lokasi" id="picker-address">                     
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="picker-lat">Latitude</label>
                      <input type="text" class="form-control required" id="picker-lat" name="lat" readonly>  
                    </div>
                    <div class="col-md-6">
                      <label for="picker-long">Longitude</label>
                      <input type="text" class="form-control required" id="picker-long" name="long" readonly>  
                    </div>
                  </div>
                  <br>
                  <div id="picker" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="form-group">
                  <label for="kejadian">Kategori kejadian</label>
                  <select class="form-control required" name="kejadian" id="kejadian">
                    <option disabled selected="selected">--Pilih Kejadian--</option>
                    <?php foreach ($kejadian as $key => $value) {?>
                    <option value="<?php echo $value->id_kejadian; ?>"><?php echo $value->nama_kejadian; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="kejadian">Sub kategori kejadian</label>
                  <select class="form-control required" name="sub_kejadian" id="sub_kejadian">
                    <option disabled selected="selected">--Pilih Sub Kejadian--</option>
                  </select>
                </div>
      </div>
      <div class="notif"></div>
        <div class="modal-footer">
          <button type="submit" id="btnReport" class="btn btn-primary">Tambah Laporan</button>
          <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button> -->
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="layananModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">
          <img id="icon_report1" src="" alt="">
        </h5>
        <div class="header_modal1"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <nav>
              <div class="nav nav-tabs" id="nav-tab1" role="tablist">
                <a class="nav-item nav-link active" id="nav-foto-tab" data-toggle="tab" href="#nav-foto1" role="tab" aria-controls="nav-foto" aria-selected="true">Foto</a>
                <a class="nav-item nav-link" id="nav-street-tab" data-toggle="tab" href="#nav-street1" role="tab" aria-controls="nav-street" aria-selected="false">Street View</a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-foto1" role="tabpanel" aria-labelledby="nav-foto-tab">
                <img id="foto_report1" src="" class="img-fluid" alt="Image" style="width:100%">
              </div>
              <div class="tab-pane fade" id="nav-street1" role="tabpanel" aria-labelledby="nav-profile-street">
                <!-- <img id="street_report" src="" class="img-fluid" alt="Street" style="width: 100%"> -->
                <div id="street_report1" style="position: absolute; background-color: transparent; overflow: visible; height:40%; width: 90%; display: block"></div>
                <br><br><br><br><br><br><br><br><br><br><br><br>    
                <!-- <small class="text-muted">
                  Please enter full screen first to view
                </small> -->
              </div>
            </div>
            <br><br>
            <?php if($user!==NULL): ?>
              <div class="fav-layanan-container">
                <!-- bintang fav disini -->
              </div>
            <?php endif ?>
            <hr align="center" style="max-width: 100%;">
            <h6>Bagikan:</h6>
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
            <strong class="text-warning" id="nama_user1"></strong> <br>
            <small class="text-muted" id="date_post1"><i class="fa fa-calendar"></i>  </small>
            <hr align="center" style="max-width: 100%;">
              <h5><span class="badge badge-success"><small><i class="fa fa-map-marker"></i> Detail lokasi</small></span></h5>
              <small class="text-muted" id="location_detail1"></small>
            <hr align="center" style="max-width: 100%;">
            <h6 align="justify" id="deskripsi_report1">
              
            </h6>
            <hr align="center" style="max-width: 100%;">
            <h5><span class="badge badge-info"><small><i class="fa fa-hospital-o"></i> Spesifikasi kamar</small></span></h5>
            <div class="table-responsive">
              <table class="table table-sm" style="text-align: center;">
                <thead class="thead-light">
                  <tr>
                    <th>Jenis kamar</th>
                    <th>Sisa kamar</th>
                    <th>Total kamar</th>
                  </tr>
                </thead>
                <tbody id="data-kamar">
                
                </tbody>
              </table>
            </div>
            <hr align="center" style="max-width: 100%; border-color:#dfdfdf">
            <!-- <h5><span class="badge badge-info"><i class="fa fa-comment-o"></i> Comments</span></h5> -->
            <ul class="nav nav-pills mb-3" id="pills-tab1" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab1" data-toggle="pill" href="#pills-home1" role="tab" aria-controls="pills-home1" aria-selected="true">Tulis Komentar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab1" data-toggle="pill" href="#pills-profile1" role="tab" aria-controls="pills-profile1" aria-selected="false">Komentar</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent1">
              <div class="tab-pane fade show active" id="pills-home1" role="tabpanel" aria-labelledby="pills-home-tab1">
                    <div class="notif-komen-layanan">
                    
                    </div>
                    <?php if($user!==NULL): ?>
                      <form class="" id="formKomentarLayanan" action="#" method="post">
                        <div class="form-group">
                          <input type="hidden" name="id_layanan" id="id_layanan">
                          <label for="isi">Komentar</label>
                          <textarea class="form-control required" id="isi_komentar_layanan" name="isi_komentar_layanan" rows="3" placeholder="Isi komentar Anda"></textarea>
                        </div>
                        <button type="submit" id="submitKomentarLayanan" class="btn btn-primary">Kirim</button>
                      </form>
                    <?php else: ?>
                      <p class="text-muted">Silakan login untuk dapat mengirim komentar.</p>
                    <?php endif ?>
              </div>
              <div class="tab-pane fade" id="pills-profile1" role="tabpanel" aria-labelledby="pills-profile-tab1">
                <div class="comments-layanan">
                  <p id="comments-layanan-loader" class="text-muted text-center">
                    <i class='fa fa-spinner fa-spin'></i> Memuat komentar
                  </p>
                  <div class="comments-layanan-container">
                    
                  </div>
                </div>
                <br>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div> -->
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" id="aboutModal" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-profile"></i> About Us</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p align="justify" class="font-weight-light"> 
                <?php 
                  echo $judul[0]->about;
                ?>
        </p>
      </div>
    </div>
  </div>
</div>