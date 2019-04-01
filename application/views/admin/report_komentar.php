<div id="picker" style="display:none;"></div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Data Komentar Report</h5>
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
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Isi komentar</th>
                                    <th rowspan="2">Tanggal komentar</th>
                                    <th colspan="2">Pengepos</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                </tr>
                                </thead>
                                <tbody id="data-komentar">
                                <?php 
                                    $i=1;
                                    foreach ($data_komentar as $key => $value): 
                                ?>
                                <tr id="post-<?php echo $value->id_post; ?>">
                                   <td><?php echo $i; ?></td>
                                   <td>
                                        <p align="justify">
                                        <?php 
                                            echo $value->isi_komentar;
                                        ?>
                                        </p>
                                   </td>
                                   <td><?php echo date("d M Y H:i A", strtotime($value->tgl_komentar)) ?></td>
                                   <td>
                                       <?php echo $value->nama; ?>
                                   </td>
                                   <td>
                                       <?php echo $value->username; ?>
                                   </td>
                                   <td>
                                        <button onclick="deleteKomentar(<?php echo $value->id_komentar.",".$value->id_post;?>)" class="btn btn-outline btn-danger dim" type="button"><i class="fa fa-trash"></i></button>
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
