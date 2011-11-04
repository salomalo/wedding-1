<?php
$album_setting = array(
    'table_name' => 'albums',
    'key_field' => 'id',
    'value_field' => 'title',
    'where' => array('kind' => $kind)
);

$image_path = './assets/media/images/' . $query['file_path'];
if ($query['file_path'] != '') {
    if (file_exists($image_path)) {
        $image_path = base_url() . 'assets/media/images/' . $query['file_path'];
    } else {
        $image_path = base_url() . 'assets/media/images/no_photo.jpg';
    }
} else {
    $image_path = base_url() . 'assets/media/images/no_photo.jpg';
}
?>
<div id="content">
    <div id="title_content"><?php echo lang('update') . ' ' . lang('article') ?></div>
    <?php echo form_open_multipart(site_url('admin_media/update_image') . '/' . $query['id'] . '/' . $kind . '/' . $per_page . '/' . $off_set); ?>
    <table class="form_content" width="100%">
        <tr>
            <td>Titre<span style="color:red">*</span></td><td>
                <?php if (form_error('title') != "") {
                ?> <div class="form_error"><?php echo generate_pure_text(form_error('title'), '<p>', '</p>'); ?></div> <?php } ?>
                <textarea cols="60" class="form_input" rows="2" name="title"> <?php echo set_value('title', $query['title']) ?> </textarea></td>
        </tr>
        <tr>
            <td>Description<span style="color:red">*</span></td><td>
                <?php if (form_error('description') != "") {
                ?> <div class="form_error"> <?php echo generate_pure_text(form_error('description'), '<p>', '</p>'); ?></div> <?php } ?>
                <?php
                $data = array('name' => 'description',
                    'id' => 'description',
                    'height' => 300,
                    'width' => 440,
                    'value' => html_entity_decode(set_value('description', strip_tags($query['description']))),
                    'type' => 'text'
                );
                echo form_fckeditor($data);
                ?>
            </td>
        </tr>
       
        <tr>
            
            <td>Image</td><td>
                <img src="<?php echo $image_path; ?>" width="300px"/>

            </td>
          <tr>
                <td>Image Upload</td>
                <td>
                    <?php if (isset($error))
                    echo $error; ?>
                     <input type="file" name="userfile" size="20" class="single" />
                
                </td>
         </tr>
          
        <tr>
            <td>Album</td>
            <td>
                <?php echo form_dropdown('album_id', dropdown_data($album_setting), $query['album_id']); ?>
            </td>
        </tr>
        
       
         
        <tr>
            <td></td><td>
                <input type="submit" name="submit" class="form_submit" value="Modifier"/>
                <input type="button" name="button" class="form_submit" value="Annuler et revenir" onclick="document.location.href='<?php echo site_url('admin_media'); ?>'"/>
            </td>
        </tr>
    </table>
    <?php form_close(); ?>
</div>
<!--END content-->
