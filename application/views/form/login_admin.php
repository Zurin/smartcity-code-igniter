<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Nov 2015 17:24:00 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Smart City | Login</title>

    <link href="<?php echo base_url(); ?>assets/themes/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/admin/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/admin/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/admin/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/admin/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">SC</h1>

            </div>
            <h3>Silakan melakukan login untuk Admin</h3>
            <form class="m-t" role="form" action="" method="post">
                <div class="form-group">
                    <input type="username" id="username" name="username" class="form-control" placeholder="Masukkan username">
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password">
                </div>

                <button type="submit" id="loginSubmit" class="btn btn-primary block full-width m-b">Login</button
            </form>
            <p class="m-t"> <small>Smart-City &copy; 2018</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/themes/admin/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/admin/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/admin/js/plugins/toastr/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            $("#loginSubmit").click(function(event) {
                event.preventDefault();
                var username = $("#username").val();
                var password = $("#password").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/actions/login_admin",
                    data: {"username": username, "password": password},
                    success: function(response) {
                        if (response == 'ok')
                        {
                            window.location = "<?php echo base_url(); ?>" + "index.php/city-admin";
                        } else {
                            toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "progressBar": true,
                            "preventDuplicates": false,
                            "positionClass": "toast-top-full-width",
                            "onclick": null,
                            "showDuration": "400",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            }
                            toastr.error("Username atau password salah!", "Login gagal")
                        }
                    }
                });
            });
        });
    </script>


</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Nov 2015 17:24:00 GMT -->
</html>