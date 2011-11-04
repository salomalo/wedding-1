
<div id="content">
    <div id="title_content">Ajouter Categories</div>
        <form method="POST" action="<?php echo site_url('admin_club/add_categories');?>">
     <table class="form_content" width="100%">
             <tr>
                <td>Titre <span style="color:red">*</span></td><td>
              <?php if (form_error('title')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('title'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" name="title" class="form_input" value="<?php echo set_value('title') ?>"/>
                </td>
             </tr>
             <tr>
                <td>Meta title </td><td>
                   <?php if (form_error('meta_title')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('meta_title'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" name="meta_title" class="form_input" value="<?php echo set_value('meta_title')?>"/></td>
            </tr>
            <tr>
                <td>Meta description </td><td>
                  <?php if (form_error('meta_description')!=""){?> <div class="form_error"> <?php echo generate_pure_text(form_error('meta_description'), '<p>', '</p>'); ?></div> <?php } ?>
                  <textarea name="meta_description" cols="40"><?php echo set_value('meta_description') ?></textarea>
                </td>
            </tr>
              <tr>
                <td></td><td>
                  <input type="submit" name="submit"  value="Enregistrer"/>
                   <input type="button" name="button"  value="Annuler et revenir" onclick="document.location.href='<?php echo site_url('admin_news/list_cat');?>'"/>
                </td>
            </tr>
        </table>
        </form>
    </div>
<!--END content-->
