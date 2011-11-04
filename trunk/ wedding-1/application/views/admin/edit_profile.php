<?php
//set month
$months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep",
    "Oct", "Nov", "Dec");
ini_set("date.timezone", "Europe/Paris");

//get year
$this_day = now();
$pattern = "%Y";
$str_year = mdate($pattern, $this_day);

for ($i = 0; $i < 12; $i++) {
    $dropdown_data[$i + 1] = $months[$i];
}
for ($i = 0; $i < 31; $i++) {
    $day_data[$i + 1] = $i + 1;
}
for ($i = $str_year-18; $i > $str_year-80; $i--) {
    $year_data[$i] = $i;
}

$group_setting = array(
    'table_name' => 'users_groups',
    'key_field' => 'id',
    'value_field' => 'name',
    'where'=>array('id >'=>1)
);

//get data
if($admin_data->num_rows>0){
    $data = $admin_data->row();
    $date_long = $data->dob;
    $pattern = "%Y-%m-%d";
    $str_date = mdate($pattern, $date_long);
    $gender = $data->gender;
    $active = $data->active;
}

//get avatar
$image_path = './assets/admin/avatar/images/' . $data->gravatar;
if ($data->gravatar != '') {
    if (file_exists($image_path)) {
        $image_path = base_url() . 'assets/admin/avatar/images/' . $data->gravatar;
    } else {
        $image_path = base_url() . 'assets/admin/avatar/noimage.gif';
    }
}  else {
    $image_path = base_url() . 'assets/admin/avatar/noimage.gif';
}
?>
<?php if (!empty($error_string)): ?>
    <!-- Woops... -->
    <div class="error_box">
    <?php echo $error_string; ?>
</div>
<?php endif; ?>
    <div id="content">
        <div id="title_content"><?php echo lang('edit_profile') ?></div>
    <?php echo form_open_multipart('admin/edit_profile/' . $data->user_id); ?>
    <table class="form_content" width="100%">
        <tr>
            <td colspan="2"><img src="<?php echo $image_path?>" alt="" height="80px"/></td>
        </tr>
        <tr>
            <td><?php echo lang('gravatar'); ?></td>
            <td><input type="file" name="userfile" id="userfile" size="25"/></td>
        </tr>
        <?php if($data->user_id != $this->session->userdata('user_id')){ ?>
        <tr>
            <td><?php echo lang('group_id'); ?></td>
            <td>
                <?php echo form_dropdown('group_id', dropdown_data($group_setting), $data->group_id, 'id="group_id"'); ?>
            </td>
        </tr>
        <?php }  else {
                echo form_hidden('group_id', $data->group_id);
            }?>
        <tr>
            <td width="10%"><?php echo lang('first_name') ?></td>
            <td>
            <?php if (form_error('first_name')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('first_name'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" class="form_input" name="first_name" size="35" maxlength="40" value="<?php  echo set_value('first_name', $data->first_name); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('last_name') ?></td>
            <td>
                <?php if (form_error('last_name')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('last_name'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" class="form_input" name="last_name" size="35" maxlength="40" value="<?php echo set_value('last_name',$data->last_name); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('display_name'); ?></td>
            <td>
                <?php if (form_error('display_name')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('display_name'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" class="form_input" name="display_name" size="35" maxlength="40" value="<?php echo set_value('display_name', $data->display_name); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('company'); ?></td>
            <td>
                <?php if (form_error('company')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('company'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" class="form_input" name="company" size="35" maxlength="40" value="<?php echo set_value('company', $data->company); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('dob'); ?></td>
            <td>
                D : <?php echo form_dropdown('birth_date', $day_data, get_date_part($str_date, 'day'), 'id="day" class="short"'); ?>
                M : <?php echo form_dropdown('birth_month', $dropdown_data, get_date_part($str_date, 'month'), 'id="month" class="short"'); ?>
                Y : <?php echo form_dropdown('birth_year', $year_data,get_date_part($str_date, 'year'), 'id="year" class="short"'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo lang('gender'); ?></td>
            <td>
            <?php
            $gender = $data->gender;
             
             $selection = array(
                                'name' => 'gender',
                                'id' => 'gender',
                                'value' => 'm' 
                                );
             echo form_radio($selection, $selection['value'], set_radio($selection['name'], $selection['value'], TRUE));
             echo "Male";
                                
             $selection = array(
                                'name' => 'gender',
                                'id' => 'gender',
                                'value' => 'f' 
                                );
             
                                                                          
             $checked = ($gender == $selection['value']) ? TRUE : FALSE  ;
             echo form_radio($selection, $selection['value'], set_radio($selection['name'], $selection['value'], $checked));
             echo "FeMale"; 

                    ?>
           
            </td>
        </tr>
        <tr>
            <td><?php echo lang('phone'); ?></td>
            <td>
                <?php if (form_error('phone')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('phone'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" class="form_input" name="phone" size="35" maxlength="40" value="<?php echo set_value('phone', $data->phone); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('mobile'); ?></td>
            <td>
                <?php if (form_error('mobile')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('mobile'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" class="form_input" name="mobile" size="35" maxlength="40" value="<?php echo set_value('mobile', $data->mobile); ?>" /></td>
        </tr>
        <tr>
            <td><?php echo lang('address'); ?></td>
            <td>
                <?php if (form_error('address')!=""){?> <div class="form_error"><?php echo generate_pure_text(form_error('address'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" class="form_input" name="address" size="35" maxlength="40" value="<?php echo set_value('address', $data->address); ?>" /></td>
        </tr>
        <?php if($data->user_id != $this->session->userdata('user_id')){ ?>
        <tr>
            <td></td>
            <td>
                <?php
                    $active_user = array(
                        'name' => 'active',
                        'id' => 'rad_active',
                        'value' => 1,
                        'checked' => $active == 1 ? TRUE : FALSE,
                        'style' => 'margin:10px',
                    );
                    echo lang('active').form_checkbox($active_user);
                ?>
            </td>
        </tr>
        <?php } else {
                echo form_hidden('active', $data->active);
            }?>
        <tr>
            <td colspan="2"><?php echo form_submit('edit_profile', lang('edit_profile')) ?></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>
<!--END content-->
