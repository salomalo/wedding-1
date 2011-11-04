

                <div id="content">
                    <div id="title_content">Catégories</div>

<?php if ($this->session->flashdata('error')): ?>
<div class="affiche_erreur">
    <?php echo $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>
                    

                    <table class="list" width="100%">
                        <thead>
                        <tr>
                            
                            <th>Titre</th>
                            <th>Meta title</th>
                            <th>Meta description</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                                                    <?php foreach ($query as $aRow): ?>
                            <tr>
                             

                             <td><?php echo $aRow['title']; ?></td>
                             <td><?php echo $aRow['meta_title']; ?></td>
                                                         <td><?php echo get_short_description($aRow['meta_description'], '30'); ?>...</td>
                             <td width="30px"><a href="<?php echo site_url('admin_club/update_categories').'/'.$aRow['id'].'/'.$perpage.'/'.$offset;?>"><img src="<?php echo base_url()?>assets/admin/images/modifier.png" alt="modifier"/></a></td>
                             <td width="30px"><a class="confirm_delete" href="<?php echo site_url('admin_club/delete_category').'/'.$aRow['id'].'/'.$perpage.'/'.$offset;?>"><img src="<?php echo base_url()?>assets/admin/images/supprimer.png" alt="supprimer"/></a></td>

                            </tr>
                         <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="delete_button">
                                            <table width="100%">
                                                <tr>
                                                <td align="left" width="200px" ><input type="submit" value="Supprimer" name="submit"/></td>
                                                <td align="right"><?php echo $pagination;?></td>
                                                </tr>
                                        </table>
                                        </div>
                    <!--END delete_button-->

                </div>
                <!--END content-->
