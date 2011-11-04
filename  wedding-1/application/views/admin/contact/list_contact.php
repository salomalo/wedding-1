
                
                <div id="content">
                    <div id="title_content">Contact</div>

<?php if ($this->session->flashdata('error')): ?>
<div class="affiche_erreur">
    <?php echo $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>
                    <form method="POST" action="<?php echo site_url('admin_contact/delete_multi_contacts').'/'.$perpage.'/'.$offset;?>" onsubmit="return go();">

                    <table class="list" width="100%">
                        <thead>
                        <tr>
                            <th width="20px"><input type="checkbox" name="deleteall" id="deleteall"/></th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Content</th>
                            <th>Posted At</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                                                    <?php foreach ($query as $aRow): ?>
                            <tr>
                             <td><input type="checkbox" name="delete[]" value="<?php echo $aRow['id']?>" class="delete" /></td>

                             <td><?php echo $aRow['last_name']; ?></td>
                             <td><?php echo $aRow['first_name']; ?></td>
                             <td><?php echo get_short_description($aRow['content'], '20'); ?>...</td>
                             <td><?php echo mdate('%d/%m/%Y', $aRow['posted_time']); ?></td>  
                             <td width="30px"><a href="<?php echo site_url('admin_contact/contact_content').'/'.$aRow['id'].'/'.$perpage.'/'.$offset;?>"><img src="<?php echo base_url()?>assets/admin/images/modifier.png" alt="modifier"/></a></td>
                             <td width="30px"><a class="confirm_delete" href="<?php echo site_url('admin_contact/delete_contact').'/'.$aRow['id'].'/'.$perpage.'/'.$offset;?>"><img src="<?php echo base_url()?>assets/admin/images/supprimer.png" alt="supprimer"/></a></td>

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
                    </form>
                </div>
                <!--END content-->
            