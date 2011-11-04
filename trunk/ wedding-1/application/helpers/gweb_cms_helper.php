<?php

function get_date_part($date, $part_to_return='') {
    $date_str = array();
    $date_str = explode('-', $date);
    if ($part_to_return == 'year') {
        return $date_str[0];
    }
    if ($part_to_return == 'month') {
        return $date_str[1];
    }
    if ($part_to_return == 'day') {
        return $date_str[2];
    }
}

function delete_my_file($file_to_delete) {
    if (file_exists($file_to_delete)) {
        unlink($file_to_delete);
    }
}

function is_user($go_after_login=TRUE) {
    $CI = & get_instance();
    if ($CI->session->userdata('clientid')) {
        return true;
    }
    if ($go_after_login == TRUE) {
        redirect('jaco/connexion');
    }
    return FALSE;
}

function delete_images($image_to_delete, $thumb_to_delete) {
    if (file_exists($image_to_delete)) {
        unlink($image_to_delete);
    }
    if (file_exists($thumb_to_delete)) {
        unlink($thumb_to_delete);
    }
}

function get_short_description($desription, $no_of_word) {
    $ret_val = '';
    $str = generate_pure_text($desription, '<p>', '</p>');
    $str_array = array();
    $str_array = explode(' ', $str);
    if ($no_of_word > count($str_array)) {
        return $str;
    }
    for ($i = 0; $i < $no_of_word; $i++) {
        $ret_val.=$str_array[$i] . ' ';
    }
    return $ret_val;
}

function generate_pure_text($html_text, $start_element, $end_element) {
    $pure_text = '';
    $str = array();
    $str = explode($start_element, $html_text);
    $first_process_text = '';
    for ($i = 0; $i < count($str); $i++) {
        $first_process_text.=$str[$i];
    }
    $str = explode($end_element, $first_process_text);
    for ($i = 0; $i < count($str); $i++) {
        $pure_text.=$str[$i];
    }
    return $pure_text;
}

function is_admin($go_after_login=TRUE) {
    $CI = & get_instance();
    if ($CI->session->userdata('user_id') AND $CI->session->userdata('group_id')) {
        return TRUE;
    }
    if ($go_after_login == TRUE) {
        redirect('admin/login');
    }
    return FALSE;
}

function is_super_admin($is_normal_admin=TRUE) {
    $CI = & get_instance();
    if ($CI->session->userdata('user_id') && $CI->session->userdata('group_id') == 1) {
        $admin_data = array
            (
            'email' => $CI->session->userdata('email'),
            'user_id' => $CI->session->userdata('user_id'),
            'group_id' => $CI->session->userdata('group_id'),
        );
        return $admin_data;
    }
    if ($is_normal_admin == TRUE) {
        redirect('admin/list_admin');
    }
    return FALSE;
}

function form_fckeditor($data = '', $value = '', $extra = '') {
    $CI = & get_instance();
    $fckeditor_basepath = $CI->config->item('fckeditor_basepath');
    require_once( $_SERVER["DOCUMENT_ROOT"] . $fckeditor_basepath . 'fckeditor.php' );
    $instanceName = ( is_array($data) && isset($data['name']) ) ? $data['name'] : $data;
    $fckeditor = new FCKeditor($instanceName);

    if ($fckeditor->IsCompatible()) {
        $fckeditor->Value = $value; //html_entity_decode($value);
        $fckeditor->BasePath = $fckeditor_basepath;
        if ($fckeditor_toolbarset = $CI->config->item('fckeditor_toolbarset_default'))
            $fckeditor->ToolbarSet = $fckeditor_toolbarset;

        if (is_array($data)) {
            if (isset($data['value']))
                $fckeditor->Value = $data['value']; html_entity_decode($data['value']);
 if (isset($data['basepath']))
                $fckeditor->BasePath = $data['basepath'];
            if (isset($data['toolbarset']))
                $fckeditor->ToolbarSet = $data['toolbarset'];
            if (isset($data['width']))
                $fckeditor->Width = $data['width'];
            if (isset($data['height']))
                $fckeditor->Height = $data['height'];
        }
        return $fckeditor->CreateHtml();
    }
    else {
        return form_textarea($data, $value, $extra);
    }
}

if (!function_exists('dropdown_data')) {

    function dropdown_data($setting) {
        $CI = & get_instance();
        if (!array_key_exists('order', $setting)) {
            $CI->db->order_by($setting['value_field'], 'asc');
        } else {
            $CI->db->order_by($setting['order']);
        }
        if (isset($setting['where'])) {
            $CI->db->where($setting['where']);
        }

        $query = $CI->db->get($setting['table_name']);
        $options = array();

        if (isset($setting['init_data'])) {
            $options[$setting['init_data']['key']] = $setting['init_data']['name'];
        }

        foreach ($query->result() as $row) {
            $options[$row->$setting['key_field']] = $row->$setting['value_field'];
        }
        return $options;
    }
    
    

}

if (! function_exists('youtube_thumb_grabber' ))
    {

        function youtube_thumb_grabber($video_code, $link_type = "embed", $size = "small", $thumb_link = "")
        {
            if ($video_code != '')
            {
                if ($link_type == "embed")
                {

                    $splited_data = explode("=",$video_code);

                    $video_unique_code = substr(strrchr($splited_data[4],"/"),1,-strlen(strrchr($splited_data[4],"&")));

                }
                else if ($link_type == "url")
                    {
                        $splited_data = explode("=",$video_code);
                        $video_unique_code = substr($splited_data[1],0,-strlen(strrchr($splited_data[1],"&")));
                    }
                    else
                    {
                        return;
                }

                if($size == "small")
                {
                    return "<a href=\"$thumb_link\"><img src=\"http://img.youtube.com/vi/$video_unique_code/2.jpg\" alt=\"No image\" /></a>";
                }
                else if ($size == "large")
                    {
                        return "<a href=\"$thumb_link\"><img src=\"http://img.youtube.com/vi/$video_unique_code/0.jpg\" alt=\"No image\" /></a>";
                    }
                    else
                    {
                        return "<a href=\"$thumb_link\"><img src=\"http://img.youtube.com/vi/$video_unique_code/2.jpg\" alt=\"No image\" /></a>";

                }

            }
                                                      
        }
    }
    
if (! function_exists('get_youtube_thumb' )) {
    
    function get_youtube_thumb($embed_link, $size="small", $width=null, $height=null) {
        if($embed_link != ''){
             $string = $embed_link;
             preg_match('#(?<=youtube\.com/embed/)\w+#', $string, $matches);
             $video_unique_code = $matches[0];
             
        }else{
            return;    
        }
        if($size == "small")
                {
                    return "<img src=\"http://img.youtube.com/vi/$video_unique_code/2.jpg\" alt=\"No image\" width = '".$width."', height='".$height."' />";
                }
                else if ($size == "large")
                    {
                        return "<img src=\"http://img.youtube.com/vi/$video_unique_code/0.jpg\" alt=\"No image\" />";
                    }
                    else
                    {
                        return "<img src=\"http://img.youtube.com/vi/$video_unique_code/2.jpg\" alt=\"No image\" />";    
                    }
        }
}

function count_news_of_category($id){
            
            $CI = & get_instance();
            $CI->load->model("News_m");
            $CI->db->select('news.*,cat_news.name');
            $CI->db->from('news');
            $CI->db->where('news.available', 1);
            $CI->db->join('cat_news', 'news.catid=cat_news.id');
            $CI->db->where('cat_news.id', $id);
            $CI->db->order_by('news.id', 'DESC');
            $query = $CI->db->get();
            return $query->num_rows();
}
?>
