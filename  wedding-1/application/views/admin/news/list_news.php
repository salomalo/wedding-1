
<div id="content">
    <div id="title_content">Tin tức</div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="affiche_erreur">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>
        <form method="POST" action="<?php echo site_url('admin_news/delete_multi_news') . '/' . $perpage . '/' . $offset; ?>" onsubmit="return go();">

            <table class="list" width="100%">
                <thead>
                    <tr>
                        <th width="20px"><input type="checkbox" name="deleteall" id="deleteall"/></th>
                        <th> Tiêu đề bài viết</th>
                        <th> Danh mục</th>
                        <th>Ngày đăng</th>
                        <th>Tác giả</th>
                        <th>Cho phép đăng</th>
                        <th colspan="2">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($query as $aRow): 
                	
                ?>
                
                    <tr>
                        <td><input type="checkbox" name="delete[]" value="<?php echo $aRow['id'] ?>" class="delete" /></td>
                        <td><?php echo $aRow['title']; ?></td>
                        <td><?php echo $aRow['name']; ?></td>
                        <td><?php echo mdate('%d/%m/%Y', $aRow['posted']); ?></td>
						<td><?php echo $aRow['username'];?></td>
                        <td>
                        <?php
                        echo($aRow['available'] == 1) ? "Có" : "Không";
                       
                        ?>
                    </td>
                    <td width="30px"><a href="<?php echo site_url('admin_news/update_news') . '/' . $aRow['id'] . '/' . $perpage . '/' . $offset; ?>"><img src="<?php echo base_url() ?>assets/admin/images/modifier.png" alt="modifier"/></a></td>
                    <td width="30px"><a class="confirm_delete" href="<?php echo site_url('admin_news/delete_news') . '/' . $aRow['id'] . '/' . $perpage . '/' . $offset; ?>"><img src="<?php echo base_url() ?>assets/admin/images/supprimer.png" alt="Xóa"/></a></td>

                </tr>
                <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="delete_button">
                    <table width="100%">
                        <tr>
                            <td align="left" width="200px" ><input type="submit" value="Xóa" name="submit" onClick="return confirm('bạn có muốn xóa không ?');"/></td>
                            <td align="right"><?php echo $pagination; ?></td>
                </tr>
            </table>
        </div>
        <!--END delete_button-->
    </form>
</div>
<!--END content-->
