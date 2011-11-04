<div id="content">
    <div id="title_content"><?php echo 'Admin '?></div>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="affiche_erreur">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>
        <form method="POST" action="<?php echo site_url('admin/delete_multi_admin'). '/' . $perpage . '/' . $offset; ?>" onsubmit="return go();">
            <table class="list" width="100%">
                <thead>
                    <tr>
                        <th width="20px"><input type="checkbox" name="deleteall" id="deleteall"/></th>
                        <th><?php echo lang('display_name')?></th>
                        <th><?php echo lang('email')?></th>
                        <th><?php echo lang('create_on')?></th>
                        <th><?php echo lang('last_login')?></th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($admin as $aRow): ?>
                    <tr>
                        <td><input type="checkbox" name="delete[]" value="<?php echo $aRow['id'] ?>" class="delete" /></td>

                        <td><?php echo $aRow['display_name']; ?></td>
                        <td><?php echo $aRow['email']; ?></td>
                        <td><?php echo mdate('%d/%m/%Y', $aRow['created_on']); ?></td>
                        <td><?php echo mdate('%d/%m/%Y', $aRow['last_login']); ?></td>
                        <td width="30px"><a href="<?php echo site_url('admin/edit_profile/' . $aRow['id']) ?>"><img src="<?php echo base_url() ?>assets/admin/images/modifier.png" alt="modifier"/></a></td>
                        <td width="30px"><a class="confirm_delete" href="<?php echo site_url('admin/delete_admin/' . $aRow['id']. '/' . $perpage . '/' . $offset) ?>"><img src="<?php echo base_url() ?>assets/admin/images/supprimer.png" alt="supprimer"/></a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="delete_button">
                <table width="100%">
                    <tr>
                        <td align="left" width="200px" ><input type="submit" value="<?php echo lang('delete')?>" name="submit"/></td>
                        <td align="right"><?php echo $pagination; ?></td>
                </tr>
            </table>
        </div>
        <!--END delete_button-->
    </form>
</div>
<!--END content-->
