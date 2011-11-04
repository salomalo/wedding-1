<?php
$album_setting = array(
    'table_name' => 'albums',
    'key_field' => 'id',
    'value_field' => 'title',
    'where' => array('kind' => 'image')
);
?>
<?php if (count(dropdown_data($album_setting)) > 0) { ?>
    <div id ="content">
    <?php if ($this->session->flashdata('error')): ?>
        <div class="affiche_erreur">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>
    <?php echo form_open_multipart('admin_media/add_images'); ?>
        <div id="title_content">Ajouter photos</div>
        <table class="form_content" width="100%">
         <tr>
                <td>Titre</td>
                <td>
                    <?php if (form_error('title') != "") {
                    ?> <div class="form_error"><?php echo generate_pure_text(form_error('title'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" class="form_input" name="title" size="35" maxlength="40" value="<?php echo set_value('title'); ?>" /></td>
            </tr>
            <tr>
                <td width="20%">Description</td>
                <td>
                    <?php if (form_error('description') != "") {?>
                        <div class="form_error"><?php echo generate_pure_text(form_error('description'), '<p>', '</p>'); ?></div> <?php } ?>
                    <?php
                    $data = array(
                        'name' => 'description',
                        'id' => 'description',
                        'height' => 300,
                        'width' => 440,
                        'value' => html_entity_decode(set_value('description')),
                        'type' => 'text'
                    );
                    echo form_fckeditor($data);
                    ?>
                </td>
            </tr>
        <tr>
            <td>Image</td>
            <td>
                <?php if (isset($error))
                    echo $error; ?>
                <input type="file" name="userfile[]" size="20" class="multi" />
            </td>
        </tr>
        <tr>
            <td>Album</td>
            <td>
<?php echo form_dropdown('album_id', dropdown_data($album_setting)); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><?php echo form_submit('submit', 'Enregistrer', 'class="form_submit"') ?></td>
        </tr>
    </table>
<?php echo form_close(); ?>
            </div>
<?php
            }else {
                $this->session->set_flashdata('error', lang('album_fail'));
                redirect('admin_media/add_album');
            }
?>
