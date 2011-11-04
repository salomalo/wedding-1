<?php echo form_open('admin/add_admin', array('id' => 'register')); ?>
<div id="content">
    <?php if ($this->session->flashdata('error')): ?>
        <div class="affiche_erreur">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>
        <div id="title_content"><?php echo lang('register') ?></div>
    <?php echo form_open_multipart('admin/add_admin'); ?>
        <table class="form_content" width="100%">
        <tr>
            <td width="20%"><?php echo lang('first_name') ?></td>
            <td>
                <?php if (form_error('first_name') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('first_name'), '<p>', '</p>'); ?></div> <?php } ?>
                <input type="text" class="form_input" name="first_name" size="35" maxlength="40" value="<?php echo set_value('first_name'); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('last_name') ?></td>
            <td>
                <?php if (form_error('last_name') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('last_name'), '<p>', '</p>'); ?></div> <?php } ?>
                <input type="text" class="form_input" name="last_name" size="35" maxlength="40" value="<?php echo set_value('last_name'); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('display_name'); ?></td>
            <td>
                <?php if (form_error('display_name') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('display_name'), '<p>', '</p>'); ?></div> <?php } ?>
                <input type="text" class="form_input" name="display_name" size="35" maxlength="40" value="<?php echo set_value('display_name'); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('email'); ?></td>
            <td>
                <?php if (form_error('email') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('email'), '<p>', '</p>'); ?></div> <?php } ?>
                <input type="text" class="form_input" name="email" size="35" maxlength="40" value="<?php echo set_value('email'); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('confirm_email'); ?></td>
            <td>
                <?php if (form_error('confirm_email') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('confirm_email'), '<p>', '</p>'); ?></div> <?php } ?>
                <input type="text" class="form_input" name="confirm_email" size="35" maxlength="40" value="<?php echo set_value('confirm_email'); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('password'); ?></td>
            <td>
                <?php if (form_error('password') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('password'), '<p>', '</p>'); ?></div> <?php } ?>
                <input type="password" class="form_input" name="password" size="35" maxlength="40" value="<?php echo set_value('password'); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('confirm_pass'); ?></td>
            <td>
                <?php if (form_error('confirm_password') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('confirm_password'), '<p>', '</p>'); ?></div> <?php } ?>
                <input type="password" class="form_input" name="confirm_password" size="35" maxlength="40" value="<?php echo set_value('confirm_password'); ?>" /></td>
        </tr>
       
       
        <tr>
            <td colspan="2"><input type="submit" name="register" value="<?php echo lang('register')?>" class="form_submit" /></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>