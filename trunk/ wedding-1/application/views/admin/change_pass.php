    <div id="content">
        <div id="title_content"><?php echo lang('change_pass') ?></div>
    <?php echo form_open(site_url('admin/change_pass' . '/' . $this->session->userdata('user_id'))); ?>
    <table class="form_content" width="100%">
        <tr>
            <td></td>
            <td>
                <?php if (isset($error) && $error): ?>
                    <div class="form_error">
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>
                </td>    
            </tr>
            <tr>
                <td><?php echo lang('old_pass') ?></td>
                <td><?php if (form_error('apass') != "") { ?> <div class="form_error"><?php echo generate_pure_text(form_error('apass'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="password" class="form_input" name="apass" size="35" maxlength="40" /></td>
            </tr>
            <tr>
                <td><?php echo lang('password') ?></td>
                <td><?php if (form_error('npass') != "") { ?> <div class="form_error"><?php echo generate_pure_text(form_error('npass'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="password" class="form_input" name="npass" size="35" maxlength="40"  /></td>
            </tr>
            <tr>
                <td><?php echo lang('confirm_pass') ?></td>
                <td><?php if (form_error('confirm_npass') != "") { ?> <div class="form_error"><?php echo generate_pure_text(form_error('confirm_npass'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="password" class="form_input" name="confirm_npass" size="35" maxlength="40"  /></td>
            </tr>
            <tr> <td></td> <td><input value="<?php echo lang('change_pass') ?>" type="submit" class="form_submit" name="submit"/></td> </tr>
        </table>
    <?php echo form_close() ?>
</div>