<?php
$selected_cat = $query->catid;
$selected_cat_setting = array(
    'table_name' => 'cat_news',
    'key_field' => 'id',
    'value_field' => 'name'
);
?>

<div id="content">
    <div id="title_content">Sửa thông tin bài viết</div>
    <?php echo form_open_multipart('admin_news/update_news/' . $query->id . '/' . $perpage . '/' . $offset); ?>
    <table class="form_content" width="100%">
        <tr>
            <td>Tiêu đề <span style="color:red">*</span></td><td>
                <?php if (form_error('title') != "") {
 ?> <div class="form_error"><?php echo generate_pure_text(form_error('title'), '<p>', '</p>'); ?></div> <?php } ?>
                <input type="text" name="title" class="form_input" value="<?php echo set_value('title',$query->title );?>"/></td>
        </tr>
        <tr>
            <td>Danh mục <span style="color:red">*</span></td><td>
<?php echo form_dropdown('catid', dropdown_data($selected_cat_setting), $selected_cat) ?>
            </td>
        </tr>
         <tr>
    <td>Chú thích <span style="color:red">*</span></td><td>
   <?php if (form_error('description')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('description'), '<p>', '</p>'); ?></div> <?php } ?>
        <textarea name="description" cols="65" rows="5"><?php echo html_entity_decode(set_value('description', $query->description)); ?></textarea> 
        </tr>
        <tr>
        	<td>Hình ảnh đại diện của bài viết</td>
        </tr>
        <tr>
        	<?php 
        		$file_path = "./assets/images/news/thumbs/".$query->img;
                	if(!file_exists($file_path) || ($query->img == null)){
                		$file_path = base_url()."assets/images/no_image/noimage.jpg";
                	}else{
                		$file_path = base_url()."assets/images/news/thumbs/".$query->img;
                	}
        	?>
            <td><img style="border:1px solid #c8c8c8" width="150px" src="<?php echo $file_path ?>"/></td>
            <td> <input type="file"  name="userfile" size="30" />
            </td></tr>
        <tr>
      
            <td>Nội dung <span style="color:red">*</span></td><td>
              <?php if (form_error('content') != "") {
 ?> <div class="form_error"><?php echo generate_pure_text(form_error('content'), '<p>', '</p>'); ?></div> <?php } ?>
                <?php
                $data = array(
                    'name' => 'content',
                    'id' => 'content',
                    'height' => 500,
                    'width' => 800,
                    'value' => html_entity_decode(set_value('content', $query->content)),
                    'type' => 'text'
                );
                echo form_fckeditor($data);
                ?>
            </td>
        </tr>

      
        <tr>
            <td></td><td>
                <input type="submit" name="submit" class="submit" value="Sửa"/>
			</td>
        </tr>
    </table>
</form>
</div>
<!--END content-->
