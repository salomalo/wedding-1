<?php if (validation_errors()): ?>
    <div class="error-box">
        <?php echo validation_errors();?>
    </div>
    <?php endif; ?>             
    <h2>Contact</h2>
<p>To contact us please fill out the form below.</p>
<?php echo form_open('contact/add');?>
<p>
    <label for="contact_email">NAME:</label>
    <?php echo form_input('contact_name',set_value('contact_name'));?>
</p>
<p>
    <label for="contact_email">EMAIL:</label>
    <?php echo form_input('contact_email',set_value('contact_email'));?>
</p>
<p>
    <label for="contact_email">COMPANY NAME:</label>
    <?php echo form_input('company_name', set_value('company_name'));?>
</p>
<p>
    <label for="contact_email">SUBJECT:</label>
    <select name="subject" id="subject">
        <option value="support">Support</option>
        <option value="sales">Sales</option>
        <option value="payments">Payments</option>
        <option value="business">Business Development</option>
        <option value="feedback">Feedback/Suggestions</option>
        <option value="other">Other</option>

    </select>
    <input id="other_subject" name="other_subject" type="text" />
</p>
<p>
    <label for="message">MESSAGE:</label>
    <?php echo form_textarea('message', set_value('message'), 'id="message"'); ?>
</p>
<p class="form_buttons">
    <input type="submit" value="SEND CONTACT" name="btnSubmit" />
	</p>
<?php echo form_close(); ?>