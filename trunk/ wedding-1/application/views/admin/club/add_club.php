<?php
 $selected_cat = set_value('catid');
 $selected_cat_setting = array(
    'table_name' => 'cat_club',
    'key_field' => 'id',
    'value_field' => 'title'
);
?>

<div id="content">
    <div id="title_content">Ajouter club</div>
    <?php echo form_open_multipart('admin_club/add_club'); ?>
    <table class="form_content" width="100%">
        <tr>
            <td>Titre <span style="color:red">*</span></td><td>
                <?php if (form_error('title') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('title'), '<p>', '</p>'); ?></div> <?php } ?>
                <input type="text" name="title" class="form_input" value="<?php echo set_value('title') ?>"/></td>
        </tr>
        <tr>
            <td>Catégorie <span style="color:red">*</span></td>
            <td>
                <?php echo form_dropdown('catid', dropdown_data($selected_cat_setting), set_value('catid')); ?>  
            </td>
        </tr>
        <tr>
            <td>Image</td>
            <td> <input type="file"  name="userfile" size="30" />
            </td>
        </tr>
        <tr>
            <td>Contenu <span style="color:red">*</span></td>
            <td>
                <?php if (form_error('content') != "") {?> <div class="form_error"><?php echo generate_pure_text(form_error('content'), '<p>', '</p>'); ?></div> <?php } ?>
                <?php
                $data = array(
                    'name' => 'content',
                    'id' => 'content',
                    'height' => 400,
                    'width' => 610,
                    'value' => html_entity_decode(set_value('content')),
                    'type' => 'text'
                );
                echo form_fckeditor($data);
                ?>
            </td>
        </tr>
        <tr>
            <td></td><td>
                <input type="submit" name="submit"  value="Enregistrer"/>
                <input type="button" name="button"  value="Annuler et revenir" onclick="document.location.href='<?php echo site_url('admin_news/list_news'); ?>'"/>
            </td>
        </tr>

    </table>
<?php echo form_close();?>
</div>
<!--END content-->
