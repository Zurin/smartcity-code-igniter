<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Data Report</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>                            
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table id="tableReport" class="table table-striped table-bordered table-hover" >
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="20%">Deskripsi</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Foto</th>
                                    <th width="20%">Kategori Kejadian</th>
                                    <th>Sub Kategori Kejadian</th>
                                    <th>Pengepos</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $i=1;
                                    foreach ($data_report as $key => $value): 
                                ?>
                                <tr id="post-<?php echo $value->id_post; ?>">
                                   <td><?php echo $i; ?></td>
                                   <td>
                                        <?php 
                                            echo substr($value->deskripsi, 0, 50); 
                                            echo strlen($value->deskripsi) > 50 ? '....' : '';
                                        ?>
                                   </td>
                                   <td>
                                        <div class="text-success"><?php echo $value->lokasi; ?></div>
                                   </td>
                                   <td id="status-view-<?php echo $value->id_post; ?>">
                                        <?php $status = $value->status; ?>
                                        <span class="label <?php if($status=='waiting') echo 'label-danger'; else if($status=='process') echo 'label-warning'; else if($status=='completed') echo 'label-primary'; ?>">
                                            <?php echo $status; ?>
                                        </span>
                                   </td>
                                   <td>
                                        <a data-fancybox="gallery" href="<?php echo base_url(); ?>assets/themes/front/img/photos/<?php echo $value->foto; ?>">
                                            <img class="img-responsive image-thumbnail" style="width:120px;" src="<?php echo base_url(); ?>assets/themes/front/img/photos/<?php echo $value->foto; ?>">
                                        </a>
                                   </td>
                                   <td>
                                        <img src="<?php echo base_url(); ?>assets/themes/front/img/marker/<?php echo $value->icon; ?>"> 
                                        -
                                        <?php echo $value->nama_kejadian; ?>
                                   </td>
                                   <td><?php echo $value->nama_sub_kejadian; ?></td>
                                   <td><?php echo $value->nama; ?></td>
                                   <td>
                                        <a href="<?php echo base_url(); ?>index.php/city-admin/report_komentar/<?php echo $value->id_post; ?>">Manage komentar</a> <br>
                                        <button id="btnEdit" onclick="editReport(<?php echo $value->id_post;?>)" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-pencil"></i></button>
                                        <button onclick="deleteReport(<?php echo $value->id_post;?>)" class="btn btn-outline btn-danger dim" type="button"><i class="fa fa-trash"></i></button>
                                   </td> 
                                </tr>
                                <?php $i++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>
