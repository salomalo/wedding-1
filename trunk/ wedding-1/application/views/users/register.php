<h2 class="page-title" id="page_title">REGISTER</h2>
<?php if(!empty($error_string)):?>
    <!-- Woops... -->
    <div class="error_box">
        <?php echo $error_string;?>
    </div>
    <?php endif;?>
<?php echo form_open('user/register', array('id'=>'register')); ?>
<ul>  
    <li><?php $this->load->view('notices');?></li>    
    <li>
        <label for="first_name"><?php echo lang('first_name')?>:</label>
        <input type="text" name="first_name" size="35" maxlength="40" value="<?php echo set_value('first_name'); ?>" />         
    </li> 
    <li>
        <label for="last_name"><?php echo lang('last_name')?>:</label>
        <input type="text" name="last_name" size="35" maxlength="40" value="<?php echo set_value('last_name'); ?>" />
    </li>

    <li>
        <label for="username"><?php echo lang('user_name')?>:</label>
        <input type="text" name="username" size="35" maxlength="100" value="<?php echo set_value('username'); ?>" />
    </li>

    <li>
        <label for="display_name"><?php echo lang('display_name');?></label>
        <input type="text"name="display_name" size="35" maxlength="100" value="<?php echo set_value('display_name'); ?>" />
    </li>
    <li>
        <label for="email"><?php echo lang('email');?> - <em style="text-transform: lowercase;"><?php echo lang('used_to_login');?></em></label>
        <input type="text" name="email" size="35" maxlength="100" value="<?php echo set_value('email');?>" />
    </li>
    <li>
        <label for="confirm_email"><?php echo lang('confirm_email')?>:</label>
        <input type="text" name="confirm_email" size="35" maxlength="100" value="<?php echo set_value('confirm_email'); ?>" />
    </li>
    <li>
        <label for="password"><?php echo lang('password');?></label>
        <input type="password" size="35" name="password" maxlength="100" />
    </li>
    <li>
        <label for="confirm_password"><?php echo lang('confirm_password');?></label>
        <input type="password" size="35" name="confirm_password" maxlength="100" />
    </li>
    <li>&nbsp;</li>
    <li style="margin-top: 5px;">
        <?php echo form_submit('register','REGISTER') ?>
    </li>
</ul>
<?php echo form_close(); ?>