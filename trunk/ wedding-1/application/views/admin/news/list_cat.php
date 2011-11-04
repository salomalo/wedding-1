

				<div id="content">
					<div id="title_content">Danh mục tin tức</div>

<?php if ($this->session->flashdata('error')): ?>
<div class="affiche_erreur">
	<?php echo $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>
                <table class="list" width="100%">
						<thead>
						<tr>
							
							<th>Tiêu đề</th>
							<th>Chú thích</th>
							<th>Meta title</th>
							<th>Meta description</th>
							<th colspan="2">Tác vụ</th>
						</tr>
						</thead>
						<tbody>
                                                    <?php foreach ($query as $aRow): ?>
							<tr>
							

							 <td><?php echo $aRow['name']; ?></td>
							 <td><?php echo get_short_description($aRow['description'], '50'); ?></td>
							 <td><?php echo $aRow['meta_title']; ?></td>
							 <td><?php echo get_short_description($aRow['meta_description'], '30'); ?>...</td>
							 <td width="30px"><a href="<?php echo site_url('admin_news/update_cat').'/'.$aRow['id'].'/'.$perpage.'/'.$offset;?>"><img src="<?php echo base_url()?>assets/admin/images/modifier.png" alt="modifier"/></a></td>
							 <td width="30px"><a class="confirm_delete" href="<?php echo site_url('admin_news/delete_cat').'/'.$aRow['id'].'/'.$perpage.'/'.$offset;?>"><img src="<?php echo base_url()?>assets/admin/images/supprimer.png" alt="supprimer" value="xóa"/></a></td>

							</tr>
						 <?php endforeach; ?>
						</tbody>
					</table>
				
                                            <table width="100%">
                                                <tr>
                                               	<td></td>
                                                <td align="right"><?php echo $pagination;?></td>
                                                </tr>
                                        </table>
                                        </div>
					<!--END delete_button-->
					
				</div>
				<!--END content-->
