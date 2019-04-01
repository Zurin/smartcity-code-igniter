<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $halaman; ?></title>
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
       html, body {
        font-family: Roboto;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-primary" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger text-white" href="<?php echo base_url(); ?>">
          <img src="<?php echo base_url(); ?>assets/themes/front/img/brand/<?php echo $judul[0]->brand; ?>" style="height: 31px;" class="d-inline-block align-top" alt="Brand logo">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle btn btn-success text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hi, <?php echo $user['username']; ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/map"><i class="fa fa-map"></i> Halaman Map</a>
                <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/user"><i class="fa fa-user"></i> Profil</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out"></i> Log Out</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container" style="margin-top: 7%">
        <?php echo $output; ?>
    </div>

    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">

    <?php
        foreach($js as $file){
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";
    ?>
    <script type="text/javascript">
      $(function () {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
      });

      var base_url = $('#base_url').val();

    </script>
    <?php if($halaman=='Edit Profile'): ?>
    <script type="text/javascript">      
      $( function() {
        $( "#tgl_lahir" ).datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: "-100:+0",
          dateFormat: 'dd-mm-yy'
        });
      } );

      function checkPasswordMatch() {
          var password = $("#password_baru").val();
          var confirmPassword = $("#password_baru2").val();

          if ((password != confirmPassword) || (password=="") || (confirmPassword=="")){
              $("#password_baru2").addClass("is-invalid").removeClass("is-valid");
              $("#password_baru").addClass("is-invalid").removeClass("is-valid");
              return false;
          }
          else {
            $("#password_baru2").addClass("is-valid").removeClass("is-invalid");
            $("#password_baru").addClass("is-valid").removeClass("is-invalid");
            return true;
          }
      }

      $(document).ready(function () {
        $("#password_baru, #password_baru2").keyup(checkPasswordMatch);
        $("#submitPassword").attr("disabled", true);
        $("#submitAvatar").attr("disabled", true);

        $("#formPassword input.required").change(function () {
            var valid = true;
            $.each($("#formPassword input.required"), function (index, value) {
                if(!$(value).val()){
                  valid = false;
                }
            });
            if(!checkPasswordMatch())
              valid = false;
            if(valid){
                $("#submitPassword").attr("disabled", false);
            }
            else{
                $("#submitPassword").attr("disabled", true);
            }
        });

        $("#formAvatar input.required").change(function () {
            var valid = true;
            $.each($("#formAvatar input.required"), function (index, value) {
                if(!$(value).val()){
                  valid = false;
                }
            });
            if(valid){
                $("#submitAvatar").attr("disabled", false);
            }
            else{
                $("#submitAvatar").attr("disabled", true);
            }
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

        $("#avatar").change(function() {
          readURL(this);
        });

        $("#submitAvatar").on('click', function() {
                $("#submitAvatar").attr('disabled', 'disabled');
                $("#submitAvatar").empty();
                $("#submitAvatar").append("Mengganti avatar <i class='fa fa-circle-o-notch fa-spin'></i>");
                event.preventDefault();
                var form = $('#formAvatar')[0];
                var formData = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/actions/change_avatar",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 'ok')
                        {
                            $("#formAvatar")[0].reset();
                            $(".notif").append('<div class="alert alert-success alert-dismissible fade collapse show" id="notif_sukses" role="alert"><strong>Sukses!</strong> Avatar anda berhasil diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $("#submitAvatar").empty();
                            $("#submitAvatar").append('Ganti Foto Avatar');
                        } 
                        else if(response == 'upload fail'){
                            $(".notif").append('<div class="alert alert-danger alert-dismissible fade collapse show" id="notif_gagal" role="alert"><strong>Gagal!</strong> Foto gagal diupload.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $('#submitAvatar').removeAttr('disabled');
                            $("#submitAvatar").empty();
                            $("#submitAvatar").append('Ganti Foto Avatar');
                        }
                        else {
                            $(".notif").append('<div class="alert alert-danger alert-dismissible fade collapse show" id="notif_gagal" role="alert"><strong>Gagal!</strong> Avatar Anda gagal diubah karena terjadi kesalahan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $('#submitAvatar').removeAttr('disabled');
                            $("#submitAvatar").empty();
                            $("#submitAvatar").append('Ganti Foto Avatar');
                        }
                    }
                });
        });

        $("#submitPassword").click(function(event) {
                $("#submitPassword").attr('disabled', 'disabled');
                $("#submitPassword").empty();
                $("#submitPassword").append("Mengubah password <i class='fa fa-circle-o-notch fa-spin'></i>");
                event.preventDefault();
                var password_lama = $("#password_lama").val();
                var password_baru = $("#password_baru").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/actions/change_password",
                    data: {"password_lama": password_lama, "password_baru": password_baru},
                    success: function(response) {
                        if (response == 'ok')
                        {
                            $("#formPassword")[0].reset();
                            $("#password_baru").removeClass("is-valid");
                            $("#password_baru2").removeClass("is-valid");
                            $("#password_lama").removeClass("is-invalid");
                            $(".notif").append('<div class="alert alert-success alert-dismissible fade collapse show" id="notif_sukses" role="alert"><strong>Sukses!</strong> Password berhasil diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $("#submitPassword").empty();
                            $("#submitPassword").append('Ubah Password');
                        } 
                        else if(response == 'wrong'){
                            $(".notif").append('<div class="alert alert-danger alert-dismissible fade collapse show" id="notif_gagal" role="alert"><strong>Gagal!</strong> Password lama Anda salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $('#submitPassword').removeAttr('disabled');
                            $("#submitPassword").empty();
                            $("#submitPassword").append('Ubah Password');
                            $("#password_lama").addClass("is-invalid");
                        }
                        else {
                            $(".notif").append('<div class="alert alert-danger alert-dismissible fade collapse show" id="notif_gagal" role="alert"><strong>Gagal!</strong> Password gagal diubah karena terjadi kesalahan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $('#submitPassword').removeAttr('disabled');
                            $("#submitPassword").empty();
                            $("#submitPassword").append('Ubah Password');
                        }
                    }
                });
          });

          $("#submitGeneral").click(function(event) {
                $("#submitGeneral").attr('disabled', 'disabled');
                $("#submitGeneral").empty();
                $("#submitGeneral").append("Mengubah data pribadi <i class='fa fa-circle-o-notch fa-spin'></i>");
                event.preventDefault();
                var nama = $("#nama").val();
                var gender = $('input[name=gender]:checked').val();
                var tgl_lahir = $("#tgl_lahir").val();
                var email = $("#email").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/actions/change_general",
                    data: {"nama": nama, "gender": gender, "tgl_lahir": tgl_lahir, "email": email},
                    success: function(response) {
                        if (response == 'ok')
                        {
                            $(".notif").append('<div class="alert alert-success alert-dismissible fade collapse show" id="notif_sukses" role="alert"><strong>Sukses!</strong> Data pribadi berhasil diubah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $("#submitGeneral").empty();
                            $("#submitGeneral").append('Simpan perubahan');
                        }
                        else {
                            $(".notif").append('<div class="alert alert-danger alert-dismissible fade collapse show" id="notif_gagal" role="alert"><strong>Gagal!</strong> Data pribadi gagal diubah karena terjadi kesalahan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $('#submitGeneral').removeAttr('disabled');
                            $("#submitGeneral").empty();
                            $("#submitGeneral").append('Simpan perubahan');
                        }
                    }
                });
          });

      });
    </script>
    <?php endif ?>
  </body>
</html>

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