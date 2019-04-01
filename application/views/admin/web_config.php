<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Data Config Web</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>                            
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" >
                                <thead>
                                <tr>
                                    <th>Judul Web (Title bar)</th>
                                    <th>Brand Logo</th>
                                    <th>About</th>
                                    <th>Favicon</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach ($title as $key => $value): 
                                ?>
                                <tr>
                                   <td id="judul-data">
                                        <?php 
                                            echo $value->judul_web;
                                        ?>
                                   </td>
                                   <td class="bg-primary" id="brand-data">
                                        <?php if($value->brand!=''): ?>
                                            <a id="pop-up" data-fancybox="gallery" href="<?php echo base_url(); ?>assets/themes/front/img/brand/<?php echo $value->brand; ?>">
                                                <img id="thumb-img" class="img-responsive image-thumbnail" style="width:350px;" src="<?php echo base_url(); ?>assets/themes/front/img/brand/<?php echo $value->brand; ?>">
                                            </a>
                                        <?php else: ?>
                                            Belum di set.
                                        <?php endif ?>
                                   </td>
                                    <td width="30%" id="about-data">
                                        <p align="justify">
                                            <?php echo $value->about; ?>
                                        </p>
                                    </td>
                                    <td width="5%" class="bg-primary" id="fav-data">
                                        <?php if($value->favicon!=''): ?>
                                            <a id="fav-up" data-fancybox="gallery" href="<?php echo base_url(); ?>assets/themes/front/img/brand/<?php echo $value->favicon; ?>">
                                                <img id="fav-img" class="img-responsive image-thumbnail" style="width:350px;" src="<?php echo base_url(); ?>assets/themes/front/img/brand/<?php echo $value->favicon; ?>">
                                            </a>
                                        <?php else: ?>
                                            Belum di set.
                                        <?php endif ?>
                                   </td>
                                   <td>
                                        <button id="btnEdit" onclick="editConfig(<?php echo $value->id;?>)" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-pencil"></i></button>
                                   </td> 
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>
