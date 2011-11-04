<?php
 $selected_cat = set_value('page');
 $selected_cat_setting = array(
    'table_name' => 'page',
    'key_field' => 'id',
    'value_field' => 'page'
);
?>
<div id="content">
	<div id="title_content">Ajouter Contenu</div>
        <form method="POST" action="<?php echo site_url('admin_content/add_content');?>">
 	<table class="form_content" width="100%">
             <tr>
                <td>Page <span style="color:red">*</span></td><td>
              <?php echo form_dropdown('page', dropdown_data($selected_cat_setting), $selected_cat) ?>
                </td>
             </tr>
             <tr>
                <td>Clé <span style="color:red">*</span></td><td>
                   <?php if (form_error('cle')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('cle'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" name="cle" class="form_input" value="<?php echo set_value('cle') ?>"/></td>
            </tr>
            <tr>
                <td>Contenu <span style="color:red">*</span></td><td>
                  <?php if (form_error('content')!=""){?> <div class="form_error"> <?php echo generate_pure_text(form_error('content'), '<p>', '</p>'); ?></div> <?php } ?>
                    <textarea name="content"><?php echo set_value('content') ?></textarea>
                </td>
            </tr>
              <tr>
                <td></td><td>
                  <input type="submit" name="submit" class="submit" value="Enregistrer"/>
                   <input type="button" name="button" class="submit" value="Annuler et revenir" onclick="document.location.href='<?php echo site_url('admin_content');?>'"/>
                </td>
            </tr>
        </table>
        </form>
	</div>
<!--END content-->
