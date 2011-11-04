<?php
if ($query->num_rows() > 0) {
    $aRow = $query->row();
}
?>
<div id ="content">
    <?php if ($this->session->flashdata('error')): ?>
        <div class="affiche_erreur">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>
    <?php echo form_open('admin_media/edit_album/' . $aRow->id); ?>
        <table class="form_content" width="100%">
            <tr>
                <td>Titre</td>
                <td>
                <?php if (form_error('title') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('title'), '<p>', '</p>'); ?></div> <?php } ?>
                <input type="text" class="form_input" name="title" size="35" maxlength="40" value="<?php echo $aRow->title; ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Description</td>
            <td>
                <?php if (form_error('description') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('description'), '<p>', '</p>'); ?></div> <?php } ?>
                <?php
                $data = array(
                    'name' => 'description',
                    'id' => 'description',
                    'height' => 300,
                    'width' => 440,
                    'value' => $aRow->description,
                    'type' => 'text'
                );
                echo form_fckeditor($data);
                ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php echo form_submit('submit','Modifier','class="form_submit"') ?></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>