<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/dashboard_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Nov 2015 17:24:00 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $halaman; ?></title>

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
        /* .blueimp-gallery .modal-body {
            position: relative;
            text-align: center;
            padding: 0 0 56.25% 0;
            overflow: hidden;
            cursor: pointer;
            background: #fff;
        } */
    </style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span>
                                <?php if($user['avatar'] != NULL): ?>
                                    <img alt="image" class="img-thumbnail" style="width:64px;" src="<?php echo base_url(); ?>assets/themes/front/img/avatar/<?php echo $user['avatar']; ?>" />
                                <?php else: ?>
                                    <img alt="image" class="img-thumbnail" style="width:64px;" src="<?php echo base_url(); ?>assets/themes/front/img/photo_dummy.jpg">
                                <?php endif ?>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $user['nama']; ?></strong>
                                </span> <span class="text-muted text-xs block"><?php echo strtoupper($user['username']); ?> <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li class="divider"></li>
                                <li><a href="#" data-toggle="modal" data-target="#logoutModal">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            SC
                        </div>
                    </li>
                    <li class="<?php echo $halaman=='Dashboard Admin' ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>index.php/city-admin"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                    </li>
                    <?php if($user['level']=='admin'): ?>
                        <li class="<?php echo $halaman=='Manage Report' ? 'active' : ''; ?>">
                            <a href="<?php echo base_url(); ?>index.php/city-admin/report"><i class="fa fa-book"></i> <span class="nav-label">Manage Report</span></a>
                        </li>
                    <?php endif; ?>
                    <?php if($user['level']=='admin'): ?>
                        <li class="<?php if($halaman=='Manage User'||$halaman=='Tambah User') echo 'active'; ?>">
                            <a href="#"><i class="fa fa-users"></i> <span class="nav-label">User</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li class="<?php if($halaman=='Tambah User') echo 'active'; ?>"><a href="<?php echo base_url(); ?>index.php/city-admin/add-user">Tambah user</a></li>
                                <li class="<?php if($halaman=='Manage User') echo 'active'; ?>"><a href="<?php echo base_url(); ?>index.php/city-admin/manage-user">Manage user</a></li>
                            </ul>
                        </li>
                        <li class="<?php if($halaman=='Judul Web'||$halaman=='Sosial Media'||$halaman=='About') echo 'active'; ?>">
                            <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Web Config</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li class="<?php if($halaman=='Judul Web') echo 'active'; ?>"><a href="<?php echo base_url(); ?>index.php/city-admin/web-title">Judul Web &amp; About</a></li>
                                <li class="<?php if($halaman=='Sosial Media') echo 'active'; ?>"><a href="<?php echo base_url(); ?>index.php/city-admin/web-socmed">Sosial Media</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </nav>

            <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Selamat datang di halaman Admin Smart City.</span>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>

            </nav>
            </div>

            <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2><?php echo $halaman; ?></h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/city-admin">Dashboard</a>
                            </li>
                            <li class="active">
                                <strong><?php echo $halaman; ?></strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-2">

                    </div>
            </div>

                <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
            
                <?php echo $output; ?>
            

            <div class="footer">
                <div>
                    <strong>Copyright</strong> Smart City &copy; 2018
                </div>
            </div>
        </div>
    </div>

    <?php
        foreach($js as $file){
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";
    ?>

    <script>
        var base_url = $("#base_url").val();
        $(document).ready(function() {
            
        });
    </script>

</body>
<!-- Mirrored from webapplayers.com/inspinia_admin-v2.3/dashboard_2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Nov 2015 17:24:11 GMT -->
</html>

<div class="modal inmodal" id="logoutModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <i class="fa fa-sign-out modal-icon"></i>
                <h4 class="modal-title">Konfirmasi keluar</h4>
                <small>Keluar dari sesi sebagai Admin</small>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin akan mengakhiri sesi sebagai Admin?</p>
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url(); ?>index.php/actions/logout_admin" class="btn btn-danger">Ya</a>
                <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>                                   
</div>

<div class="modal inmodal fade" id="modalEditReport" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Update data report</h4>
                </div>
                    <div class="modal-body">
                        <form action="" id="formEditReport">
                            <input type="hidden" id="id_post" name="id_post">
                            <div class="form-group">
                                <label class="control-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="4" placeholder="Masukkan keterangan"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ditangani oleh</label>
                                <input type="text" class="form-control" name="ditangani" id="ditangani" placeholder="Masukkan dinas/ lembaga yang menangani">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Status</label>
                                <select class="form-control m-b" name="status" id="status">
                                    <option value="waiting">Waiting</option>
                                    <option value="process">Process</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitUpdateReport" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>   
</div>

<div class="modal inmodal fade" id="modalEditUser" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Update data user</h4>
                </div>
                    <div class="modal-body">
                        <form action="" id="formEditUser">
                            <input type="hidden" id="id_user" name="id_user">
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nama user</label>
                                <input type="text" class="form-control" name="nama" id="nama" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">E-mail</label>
                                <input type="text" class="form-control" name="email" id="email" readonly>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Level user</label>
                                <div class="i-checks"><label> <input type="radio" class="iradio_square-green" id="radioMember" value="member" name="level"> <i></i> Member </label></div>
                                <div class="i-checks"><label> <input type="radio" class="iradio_square-green" id="radioAdminRS" value="adminRS" name="level"> <i></i> Admin RS</label>
                                <div class="i-checks"><label> <input type="radio" class="iradio_square-green" id="radioAdmin" value="admin" name="level"> <i></i> Admin </label>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitUpdateUser" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>   
</div>

<div class="modal inmodal fade" id="modalEditLayanan" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Update data layanan</h4>
                </div>
                    <div class="modal-body">
                        <form action="" id="formEditLayanan" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id_layanan" name="id_layanan">
                            <img id="preview" alt="Preview" style="max-width: 50%">    
                            <div class="form-group">
                                <label class="control-label">Foto</label>
                                <div class="form-group" id="fotoControl">
                                    <input type="file" name="foto" class="form-control-file" id="foto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitUpdateLayanan" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>   
</div>

<div class="modal inmodal fade" id="modalEditKamar" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Update data kamar</h4>
                </div>
                    <div class="modal-body">
                        <form action="" id="formEditKamar" method="post">
                            <input type="hidden" id="id_kamar" name="id_kamar">
                            <input type="hidden" id="id_layanan_kamar" name="id_layanan_kamar">
                            <div class="form-group">
                                <label class="control-label">Jenis Kamar</label>
                                <input type="text" class="form-control" name="jenis" id="jenis">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Sisa Kamar</label>
                                        <input type="number" class="form-control" name="sisa" id="sisa">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Total Kamar</label>
                                        <input type="number" class="form-control" name="total" id="total">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitUpdateKamar" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>   
</div>

<div class="modal inmodal fade" id="modalEditConfig" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Config Web</h4>
                </div>
                    <div class="modal-body">
                        <form action="" id="formConfig" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label class="control-label">Judul</label>
                                <div class="form-group" id="judulControl">
                                    <input type="text" name="judul_web" class="form-control" id="judul">
                                </div>
                            </div>
                            <div class="bg-primary">
                                <img id="preview-brand" alt="Preview brand" style="max-width: 50%">    
                            </div>
                            <div class="form-group">
                                <label class="control-label">Brand</label>
                                <div class="form-group" id="brandControl">
                                    <input type="file" name="brand" class="form-control-file" id="brand">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">About</label>
                                <textarea class="form-control" name="about" id="about" cols="30" rows="14"></textarea>
                            </div>
                            <div class="bg-primary">
                                <img id="preview-favicon" alt="Preview favicon" style="max-width: 50%">    
                            </div>
                            <div class="form-group">
                                <label class="control-label">Favicon (harus .ico/.png untuk support browser)</label>
                                <div class="form-group" id="faviconControl">
                                    <input type="file" name="favicon" class="form-control-file" id="favicon">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitConfig" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>   
</div>

<div class="modal inmodal fade" id="modalAddSocmed" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Tambah Data Sosial Media</h4>
                </div>
                    <div class="modal-body">
                        <form action="" id="formAddSocmed" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label">Jenis sosial media</label>
                                <div class="form-group" id="jenisControl">
                                    <select name="fa_sosmed" id="fa_sosmed" class="form-control">
                                        <option value="fa fa-facebook-square">Facebook</option>
                                        <option value="fa fa-twitter-square">Twitter</option>
                                        <option value="fa fa-google-plus-square">Google+</option>
                                        <option value="fa fa-instagram">Instagram</option>
                                        <option value="fa fa-whatsapp">Whatsapp</option>
                                        <option value="fa fa-youtube-square">Youtube Channel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">URL</label>
                                <div class="form-group" id="urlControl">
                                    <input type="text" name="url" class="form-control" id="url">
                                </div>
                            </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitAddSocmed" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>   
</div>

<div class="modal inmodal fade" id="modalEditSocmed" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Update Data Sosial Media</h4>
                </div>
                    <div class="modal-body">
                        <form action="" id="formUpdateSocmed" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="id_sosmed" name="id_sosmed">
                            <div class="form-group">
                                <label class="control-label">Jenis sosial media</label>
                                <div class="form-group" id="jenisControl">
                                    <select name="fa_sosmed" id="fa_sosmed_edit" class="form-control">
                                        <option value="fa fa-facebook-square">Facebook</option>
                                        <option value="fa fa-twitter-square">Twitter</option>
                                        <option value="fa fa-google-plus-square">Google+</option>
                                        <option value="fa fa-instagram">Instagram</option>
                                        <option value="fa fa-whatsapp">Whatsapp</option>
                                        <option value="fa fa-youtube-square">Youtube Channel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">URL</label>
                                <div class="form-group" id="urlControl">
                                    <input type="text" name="url" class="form-control" id="url_edit">
                                </div>
                            </div>                         
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitUpdateSocmed" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>   
</div>