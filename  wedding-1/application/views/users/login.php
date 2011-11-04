<h2 class="page-title" id="page_title">LOGIN</h2>
<?php if (validation_errors()): ?>
<div class="error_box">
    <?php echo validation_errors();?>
</div>
<?php endif; ?>

<?php echo form_open('user/login', array('id'=>'login')); ?>
<ul>
    <li>
        <label for="email">EMAIL:</label>
        <input type="text" id="email" name="email" maxlength="120" />
    </li>
    <li>
        <label for="password">PASSWORD:</label>
        <input type="password" id="password" name="password" maxlength="20" />
    </li>
    <li id="remember_me">
        <?php echo form_checkbox('remember', '1', FALSE); ?>REMEMBER ME
    </li>
    <li class="form_buttons">
        <input type="submit" value="LOGIN" name="btnLogin" /> or <?php echo anchor('register','REGISTER');?>
    </li>
    <li>
        <?php echo anchor('users/reset_pass','FORGOT PASS');?> | <?php echo anchor('register', 'REGISTER');?>
    </li>
</ul>
<?php echo form_close(); ?>