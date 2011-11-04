<div id="content">
    <div id="title_content"><?php echo "Liste ".$kind; ?></div>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="affiche_erreur">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>
        <form method="POST" action="<?php echo site_url('admin_media/delete_multi_medias'). '/'.$kind.'/' . $per_page . '/' . $off_set; ?>" onsubmit="return go();">
            <table class="list" width="100%">
                <thead>
                    <tr>
                        <th width="20px"><input type="checkbox" name="deleteall" id="deleteall"/></th>
                        <th width="10%"></th>
                        <th width="15%">Title</th>  
                        <th width="30%">Description</th>  
                        <th width="25%">Album</th>
                        <th width="5%">Date publié</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($images as $aRow): ?>
                    <?php
                        $image_path = './assets/media/images/thumbs/' . $aRow['file_path'];
                        if ($aRow['file_path'] != '') {
                            if (file_exists($image_path)) {
                                $image_path = base_url() . 'assets/media/images/thumbs/' . $aRow['file_path'];
                            } else {
                                $image_path = base_url() . 'assets/media/images/no_photo.jpg';
                            }
                        }  else {
                            $image_path = base_url() . 'assets/media/images/no_photo.jpg';
                        }
                        $file_title = "NULL"; 
                        if($aRow['title'] != NULL){
                            $file_title = $aRow['title'];    
                        }
                        
                        $file_description = "NULL";
                        if($aRow['description'] != NULL){
                            $file_description = $aRow['description'];    
                        }
                    ?>
                    <tr>
                        <td><input type="checkbox" name="delete[]" value="<?php echo $aRow['id'] ?>" class="delete" /></td>
                        <?php if($aRow['kind']=='image'){?>
                        <td><img src="<?php echo $image_path; ?>" alt="" width="80px"/></td>
                        <?php }else{?>
                        <td></td>
                        <?php }?>
                        <td><?php echo $file_title; ?></td>
                        <td><?php echo get_short_description($file_description, '20'); ?></td>
                        <td><a href="<?php echo site_url('admin_media/list_media_by_album/' . $aRow['album_id'].'/'.$kind.'/' . $per_page . '/' . $off_set) ?>"><?php echo $aRow['album']; ?></a></td>
                        <td><?php echo mdate('%d/%m/%Y', $aRow['upload_time']); ?></td>
                        <?php if($aRow['kind'] == "video"){?>
                        <td width="30px"><a href="<?php echo site_url('admin_media/update_media/' . $aRow['id'].'/'.$kind.'/' . $per_page . '/' . $off_set) ?>"><img src="<?php echo base_url() ?>assets/admin/images/modifier.png" alt="modifier"/></a></td>
                        <?php }else{   ?>
                        <td width="30px"><a href="<?php echo site_url('admin_media/update_image/' . $aRow['id'].'/'.$kind.'/' . $per_page . '/' . $off_set) ?>"><img src="<?php echo base_url() ?>assets/admin/images/modifier.png" alt="modifier"/></a></td>     
                        <?php }?>
                        <td width="30px"><a class="confirm_delete" href="<?php echo site_url('admin_media/delete_media/' . $aRow['id']. '/'.$kind.'/' . $per_page . '/' . $off_set) ?>"><img src="<?php echo base_url() ?>assets/admin/images/supprimer.png" alt="supprimer"/></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="delete_button">
                <table width="100%">
                    <tr>
                        <td align="left" width="200px" ><input type="submit" class="form_submit" value="<?php echo lang('delete')?>" name="submit"/></td>
                        <td align="right"><?php echo $pagination; ?></td>
                </tr>
            </table>
        </div>
        <!--END delete_button-->
    </form>
</div>
<!--END content-->
