<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $judul[0]->judul_web." - ".$halaman; ?></title>

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

  <body style="background-color: #6BB9F0;">

    <?php echo $output; ?>
    
    <?php
        foreach($js as $file){
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";
    ?>

    <?php if($halaman == 'Register User'){ ?>
    <script type="text/javascript">
        function check_if_exists() {
          var username = $("#username").val();
          $.ajax(
            {
                type:"post",
                url: "<?php echo base_url(); ?>index.php/actions/username_check",
                data:{username:username},
                success:function(response)
                {
                    if ((response == 'true') && username != '')
                    {
                      $("#username").addClass("is-valid").removeClass("is-invalid");
                      return true;
                    }
                    else
                    {
                      $("#username").addClass("is-invalid").removeClass("is-valid");
                      return false;
                    }
                }
            });
          }

        $(document).ready(function (){
            $("#registerButton").click(function(event) {
                event.preventDefault();
                var nama = $("#nama").val();
                var username = $("#username").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var gender = $('input[name=gender]:checked').val();;
                var tgl_lahir = $("#tgl_lahir").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/actions/register",
                    data: {"nama": nama, "username": username, "email": email, "password": password, "gender": gender, "tgl_lahir": tgl_lahir},
                    success: function(response) {
                        if (response == 'ok')
                        {
                            $("#notif_sukses").show();
                            $("#notif_sukses").addClass("show");
                            $("#register")[0].reset();
                            $("#password").removeClass("is-valid");
                            $("#password2").removeClass("is-valid");
                            $("#email").removeClass("is-valid");
                            $("#username").removeClass("is-valid");
                            $("#username").removeClass("is-invalid");
                        } else {
                            $("#notif_gagal").addClass("show");
                        }
                    }
                });
            });
        });
    </script>
    <?php } ?>

    <?php if($halaman == 'Login User'){ ?>
        <script type="text/javascript">
            $(document).ready(function (){
            $("#loginButton").click(function(event) {
                event.preventDefault();
                var username = $("#username").val();
                var password = $("#password").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/actions/login",
                    data: {"username": username, "password": password},
                    success: function(response) {
                        if (response == 'ok')
                        {
                            window.location = "<?php echo base_url(); ?>" + "index.php/map";
                        } else {
                            // $("#notif_gagal").addClass("show");
                            $(".notif").append('<div class="alert alert-danger alert-dismissible fade collapse show" id="notif_gagal" role="alert"><strong>Login gagal!</strong> Username atau password salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        }
                    }
                });
            });
        });
        </script>
    <?php } ?>

  </body>

</html>
