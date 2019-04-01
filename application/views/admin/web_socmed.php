<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Data Sosial Media Web</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>                            
                        </div>
                    </div>
                    <div class="ibox-content">
                        <button data-toggle="modal" data-target="#modalAddSocmed" class="btn btn-outline btn-success dim" type="button"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tableSocmed">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Icon sosmed</th>
                                    <th>URL</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody id="data-socmed">
                                <?php 
                                    $i=1;
                                    foreach ($data_sosmed as $key => $value): 
                                ?>
                                <tr>
                                   <td><?php echo $i; ?></td>
                                   <td style="font-size: 32px;">
                                        <i class="<?php echo $value->fa_sosmed; ?>"></i>
                                   </td>
                                   <td>
                                        <a href="<?php echo $value->url; ?>" target="_blank"><?php echo $value->url; ?></a>
                                   </td>
                                   <td>
                                        <button id="btnEdit" onclick="editSocmed(<?php echo $value->id_sosmed;?>)" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-pencil"></i></button>
                                        <button id="btnDelete" onclick="deleteSocmed(<?php echo $value->id_sosmed;?>)" class="btn btn-outline btn-danger dim" type="button"><i class="fa fa-trash"></i></button>
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
