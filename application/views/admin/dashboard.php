<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">Laporan</span>
                                <h5>Jumlah</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
                                    <i class="fa fa-book"></i>
                                    <?php echo $laporan; ?>
                                </h1>
                                <small>Total laporan</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">Kategori Kejadian</span>
                                <h5>Banyak</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
                                    <i class="fa fa-archive"></i>
                                    <?php echo $kejadian; ?>
                                </h1>
                                <small>Total kategori Kejadian</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">Member</span>
                                <h5>Pengguna</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">
                                    <i class="fa fa-users"></i>
                                    <?php echo $pengguna; ?>
                                </h1>
                                <small>Total member</small>
                            </div>
                        </div>
                    </div>
    </div>
</div>