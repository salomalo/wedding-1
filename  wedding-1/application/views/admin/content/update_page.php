
<div id="content">
	<div id="title_content">Modifier Page</div>
       <form method="POST" action="<?php echo site_url('admin_content/update_page').'/'.$query['id'].'/'.$perpage.'/'.$offset;?>">
 	<table class="form_content" width="100%">
             <tr>
                <td>Page <span style="color:red">*</span></td><td>
              <?php if (form_error('page')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('page'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" name="page" class="form_input" value="<?php echo $query['page'] ?>"/>
                </td>
             </tr>
             <tr>
                <td>Meta title </td><td>
                   <?php if (form_error('meta_title')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('meta_title'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" name="meta_title" class="form_input" value="<?php echo $query['meta_title']?>"/></td>
            </tr>
            <tr>
                <td>Meta description </td><td>
                  <?php if (form_error('meta_description')!=""){?> <div class="form_error"> <?php echo generate_pure_text(form_error('meta_description'), '<p>', '</p>'); ?></div> <?php } ?>
                    <textarea name="meta_description"><?php echo $query['meta_description'] ?></textarea>
                </td>
            </tr>
              <tr>
                <td></td><td>
                 <input type="submit" name="submit" class="submit" value="Enregistrer"/>
                   <input type="button" name="button" class="submit" value="Annuler et revenir" onclick="document.location.href='<?php echo site_url('admin_content/list_page').'/'.$perpage.'/'.$offset;?>'"/>
                 </td>
            </tr>
        </table>
        </form>
	</div>
<!--END content-->
