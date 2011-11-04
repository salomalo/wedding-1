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
    <?php echo form_open_multipart(site_url('admin_media/update_media') . '/' . $query['id'] . '/' . $kind . '/' . $per_page . '/' . $off_set); ?>
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
                    'value' => html_entity_decode(set_value('description', $query['description'])) ,
                    'type' => 'text'
                );
                echo form_fckeditor($data);
                ?>
            </td>
        </tr>
        <?php if($query['kind'] == "image"){?>
        <tr>
            
            <td>Image</td><td>
                <img src="<?php echo $image_path; ?>" width="300px"/>

            </td>
            <?php }else{ ?>
             <td>Video</td><td>
                <?php echo $query['file_path']; ?>

            </td>   
            
        </tr>
          <tr>
                    <td>Video Link</td>
                    <td>
                    <?php if (form_error('title') != "") {
                    ?> <div class="form_error"><?php echo generate_pure_text(form_error('video_link'), '<p>', '</p>'); ?></div> <?php } ?>
                    <input type="text" class="form_input" name="video_link" size="35" value="<?php echo set_value('video_link', $query['file_path']); ?>" /></td>
            </tr>
        <?php } ?>
        
        <tr>
            <td>Album</td>
            <td>
                <?php echo form_dropdown('album_id', dropdown_data($album_setting), $query['album_id']); ?>
            </td>
        </tr>
         <?php if($query['kind'] == "video"){?>
         <tr>
                <td>Video available</td>
                <td>
                <?php
                    $active = array(
                        'name' => 'available',
                        'id' => 'available',
                        'value' => 1,
                        'checked' => set_value('available', $query['available']),
                        'style' => 'margin:10px',
                    );
                    echo form_checkbox($active). "available";
                ?>
                </td>
            </tr>
         <?php }?>
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
