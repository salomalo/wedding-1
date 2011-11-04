<div id="content">
    <div id="title_content">Liste Album</div>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="affiche_erreur">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>
        <form method="POST" action="<?php echo site_url('admin_media/delete_multi_album') ?>" onsubmit="return go();">
            <table class="list" width="100%">
                <thead>
                    <tr>
                        <th width="20px"><input type="checkbox" name="deleteall" id="deleteall"/></th>
                        <th>Album</th>
                        <th>Catégorie</th>
                         <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($albums as $aRow): ?>
                    <tr>
                        <td><input type="checkbox" name="delete[]" value="<?php echo $aRow['id'] ?>" class="delete" /></td>
                        <td><a href="<?php echo site_url('admin_media/list_media_by_album/' . $aRow['id'].'/'.$aRow['kind'].'/' . $per_page . '/' . $off_set) ?>"><?php echo $aRow['title']; ?></a></td>
                        <td><?php echo $aRow['kind']; ?></td>
                        <td width="30px"><a href="<?php echo site_url('admin_media/edit_album/' . $aRow['id']) ?>"><img src="<?php echo base_url() ?>assets/admin/images/modifier.png" alt="modifier"/></a></td>
                        <td width="30px"><a class="confirm_delete" href="<?php echo site_url('admin_media/delete_album/' . $aRow['id'].'/'.$aRow['kind']) ?>"><img src="<?php echo base_url() ?>assets/admin/images/supprimer.png" alt="supprimer"/></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="delete_button">
                <table width="100%">
                    <tr>
                        <td align="left" width="200px" ><input type="submit" class="form_submit" value="Delete" name="submit"/></td>
                        <td align="right"><?php echo $pagination; ?></td>
                </tr>
            </table>
        </div>
        <!--END delete_button-->
    </form>
</div>
<!--END content-->
