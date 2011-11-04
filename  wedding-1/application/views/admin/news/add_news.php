<?php
 $selected_cat = set_value('catid');
 $selected_cat_setting = array(
    'table_name' => 'cat_news',
    'key_field' => 'id',
    'value_field' => 'name'
);
?>

<div id="content">
    <div id="title_content">Đăng tin mới</div>
        <?php echo form_open_multipart('admin_news/add_news');?>
     <table class="form_content" width="100%">
             <tr>
                <td>Tiêu đề <span style="color:red">*</span></td><td>
               <?php if (form_error('title')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('title'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" name="title" class="form_input" value="<?php echo set_value('title') ?>"/></td>
             </tr>
             <tr>
                <td>Danh mục <span style="color:red">*</span></td><td>
<?php echo form_dropdown('catid', dropdown_data($selected_cat_setting), $selected_cat) ?>
                </td>
            </tr>
             <tr>
                <td>Mô tả <span style="color:red">*</span></td><td>
               <?php if (form_error('description')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('description'), '<p>', '</p>'); ?></div> <?php } ?>
                    <textarea name="description" cols="65" rows="5"><?php echo set_value('description'); ?></textarea> 
             </tr>
             <tr>
                 <td>Hình ảnh</td>
           <td> <input type="file"  name="userfile" size="30" />
           </td></tr>
             <tr>
                <td>Nội dung <span style="color:red">*</span></td><td>
               <?php if (form_error('content')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('content'), '<p>', '</p>'); ?></div> <?php } ?>
                <?php
                    
                    $data=array(
                    'name'=>'content',
                    'id'=>'content',
                    'height'=>500,
                    'width'=>800,
                    'value' => html_entity_decode(set_value('content')),
                    'type' =>'text'
                    );
                    echo form_fckeditor($data);
                ?>
                </td>
            </tr>
             <tr>
                <td>Đăng tin này <span style="color:red">*</span></td><td>
                	<?php 
                	$selected_status = array("0" => "Không", "1" => "Có");
                
					echo form_dropdown('status', $selected_status, 0); ?>
                </td>
            </tr>
            
              <tr>
                <td></td><td>
                  <input type="submit" name="submit"  value="Đăng tin"/>
                   
                </td>
            </tr>
            
        </table>
        </form>
    </div>
<!--END content-->
