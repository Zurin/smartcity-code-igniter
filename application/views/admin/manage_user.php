<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Data User</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>                            
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table id="tableUser" class="table table-striped table-bordered table-hover" >
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>E-mail</th>
                                    <th>Tanggal lahir</th>
                                    <th>Gender</th>
                                    <th>Avatar</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $i=1;
                                    foreach ($data_user as $key => $value): 
                                ?>
                                <tr id="user-<?php echo $value->id_user; ?>">
                                   <td><?php echo $i; ?></td>
                                   <td>
                                        <?php 
                                            echo $value->username;
                                        ?>
                                   </td>
                                   
                                   <td>
                                        <?php echo $value->nama; ?>
                                   </td>
                                   <td><?php echo $value->email; ?></td>
                                   <td><?php echo date("d-m-Y", strtotime($value->tgl_lahir)); ?></td>
                                   <td><?php echo $value->gender=="l" ? "Laki-laki" : "Perempuan"; ?></td>
                                   <td>
                                        <?php if($value->avatar != NULL): ?>
                                            <a data-fancybox="gallery" href="<?php echo base_url(); ?>assets/themes/front/img/avatar/<?php echo $value->avatar; ?>">
                                                <img class="img-responsive image-thumbnail" style="width:48px;" src="<?php echo base_url(); ?>assets/themes/front/img/avatar/<?php echo $value->avatar; ?>">
                                            </a>
                                        <?php else: ?>
                                            Not set
                                        <?php endif ?>
                                   </td>
                                   <td id="level-<?php echo $value->id_user; ?>">
                                        <?php $level = $value->level; ?>
                                        <span class="label <?php if($level=='admin') echo 'label-success'; else if($level=='adminRS') echo 'label-warning'; else echo 'label-primary'; ?>">
                                            <?php echo $level; ?>
                                        </span>
                                   </td>
                                   <td>
                                        <button id="btnEdit" onclick="editUser(<?php echo $value->id_user;?>)" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-pencil"></i></button>
                                        <button onclick="deleteUser(<?php echo $value->id_user;?>)" class="btn btn-outline btn-danger dim" type="button"><i class="fa fa-trash"></i></button>
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
