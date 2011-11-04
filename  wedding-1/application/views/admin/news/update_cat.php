
<div id="content">
	<div id="title_content">Thay đổi thông tin danh mục</div>
       <form method="POST" action="<?php echo site_url('admin_news/update_cat').'/'.$query['id'].'/'.$perpage.'/'.$offset;?>">
 	<table class="form_content" width="100%">
             <tr>
                <td>Tên danh mục <span style="color:red">*</span></td><td>
              <?php if (form_error('title')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('title'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" name="title" class="form_input" value="<?php echo set_value('title', $query['name'] )?>"/>
                </td>
             </tr>
             <tr>
                <td>Chú thích</td><td>
              <?php if (form_error('description')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('description'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" name="description" class="form_input" value="<?php echo set_value('description') ?>"/>
                </td>
             </tr>
             <tr>
                <td>Meta title </td><td>
                   <?php if (form_error('meta_title')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('meta_title'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" name="meta_title" class="form_input" value="<?php echo set_value('meta_title', $query['meta_title'])?>"/></td>
            </tr>
            <tr>
                <td>Meta description </td><td>
                  <?php if (form_error('meta_description')!=""){?> <div class="form_error"> <?php echo generate_pure_text(form_error('meta_description'), '<p>', '</p>'); ?></div> <?php } ?>
                    <textarea name="meta_description"><?php echo set_value('meta_description', $query['meta_description']) ?></textarea>
                </td>
            </tr>
              <tr>
                <td></td><td>
                 <input type="submit" name="submit" class="submit" value="Thay đổi"/>
                   
                 </td>
            </tr>
        </table>
        </form>
	</div>
<!--END content-->
