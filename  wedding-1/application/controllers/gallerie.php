<?php
  class Gallerie extends Gallerie_Controller{
      public function __construct(){
          parent :: __construct();
          $this->load->model('Media_m');
      }
      
      function index(){
          $this->photo_albums();
      }
      
      function photo_albums(){
        $per_page = $this->uri->segment(3);
        if ($per_page == "") {
            $per_page = 8;
        }
        $off_set = $this->uri->segment(4);
        if ($off_set == "") {
            $off_set = 0;
        }
        /*$config['full_tag_open'] = "<div id='wrapperpage'>";
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<span id="pageactive"> ';
        $config['cur_tag_close'] = ' </span>';*/
        $config['next_link'] = 'Suiv.';
        $config['prev_link'] = 'Prec.';
        $config['base_url'] = base_url() . 'index.php/gallerie/photo_albums/' . $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->Media_m->count_photo_albums();
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['list_photo_album'] = $this->Media_m->get_photo_albums($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste photo albums";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        
        $this->display_view('home/gallerie/photo_album');
      }
         
      
      function albums($id){
        $per_page = $this->uri->segment(4);
        if ($per_page == "") {
            $per_page = 4;
        }
        $off_set = $this->uri->segment(5);
        if ($off_set == "") {
            $off_set = 0;
        }
        /*$config['full_tag_open'] = "<div id='wrapperpage'>";
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<span id="pageactive"> ';
        $config['cur_tag_close'] = ' </span>';*/
        $config['next_link'] = 'Suiv.';
        $config['prev_link'] = 'Prec.';
        $config['base_url'] = base_url() . 'index.php/gallerie/albums/'.$id.'/'. $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 5;
        $config['total_rows'] = $this->Media_m->count_other_photo_album($id);
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        } 
        $this->_data['default_photo'] = $this->Media_m->defaul_photo_of_album($id);   
        $this->_data['current_photo_album'] = $this->Media_m->list_photo_by_album ($id);
        $this->_data['list_other_album'] = $this->Media_m->list_other_photo_album($id, $config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste photo";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_view('home/gallerie/photo_list');     
      }
      
      function list_video(){
          $this->_data['lastest_videos'] = $this->Media_m->get_lastest_feature_video_link();
          $this->display_view('home/gallerie/video_page');
      }
      
      function list_video_albums(){
        $per_page = $this->uri->segment(3);
        if ($per_page == "") {
            $per_page = 8;
        }
        $off_set = $this->uri->segment(4);
        if ($off_set == "") {
            $off_set = 0;
        }
        /*$config['full_tag_open'] = "<div id='wrapperpage'>";
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<span id="pageactive"> ';
        $config['cur_tag_close'] = ' </span>';*/
        $config['next_link'] = 'Suiv.';
        $config['prev_link'] = 'Prec.';
        $config['base_url'] = base_url() . 'index.php/gallerie/list_video_albums/'. $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->Media_m->count_video_albums();
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['video_albums'] = $this->Media_m->list_video_albums($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste video";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_view('home/gallerie/video_albums_list');     
      }
      
      function album_video($id){
            $per_page = $this->uri->segment(4);
            if ($per_page == "") {
                $per_page = 4;
            }
            $off_set = $this->uri->segment(5);
            if ($off_set == "") {
                $off_set = 0;
            }
          
            /*$config['full_tag_open'] = "<div id='wrapperpage'>";
            $config['full_tag_close'] = '</div>';
            $config['cur_tag_open'] = '<span id="pageactive"> ';
            $config['cur_tag_close'] = ' </span>';*/
            $config['next_link'] = 'Suiv.';
            $config['prev_link'] = 'Prec.';
            $config['base_url'] = base_url() . 'index.php/gallerie/album_video/'.$id.'/'.$per_page . '/';
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 5;
            $newest_video = $this->_data['newest_video'] = $this->Media_m->get_newest_video_in_album($id); 
            $config['total_rows'] = $this->Media_m->count_video_in_album($newest_video->id);
            if ($off_set > 0 && $off_set == $config['total_rows']) {
                $off_set = $off_set - $per_page;
            }
            
            $this->_data['video'] = $this->Media_m->get_other_video_in_album($id, $newest_video->id, $config['per_page'], $off_set);
            $this->pagination->initialize($config);
            $this->_data['pagination'] = $this->pagination->create_links();
            $this->_data['page_title'] = "Liste video";
            $this->_data['perpage'] = $per_page;
            $this->_data['offset'] = $off_set;
            $this->_data['album_id'] = $id;
            
            $this->display_view('home/gallerie/video_album_details');         
      } 
      
      function video($video_id){
           $album_id =  $this->uri->segment(4);
           $per_page = $this->uri->segment(5);
            if ($per_page == "") {
                $per_page = 3;
            }
            $off_set = $this->uri->segment(6);
            if ($off_set == "") {
                $off_set = 0;
            }
          
            /*$config['full_tag_open'] = "<div id='wrapperpage'>";
            $config['full_tag_close'] = '</div>';
            $config['cur_tag_open'] = '<span id="pageactive"> ';
            $config['cur_tag_close'] = ' </span>';*/
            $config['next_link'] = 'Suiv.';
            $config['prev_link'] = 'Prec.';
            $config['base_url'] = base_url() . 'index.php/gallerie/video/'.$video_id.'/'.$album_id.'/'.$per_page . '/';
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 6;
            $current_video = $this->_data['current_video'] = $this->Media_m->get_current_video_link($video_id);
            $config['total_rows'] = $this->Media_m->count_video_in_album($current_video->id);
            if ($off_set > 0 && $off_set == $config['total_rows']) {
                $off_set = $off_set - $per_page;
            }
            
            $this->_data['video'] = $this->Media_m->get_other_video_in_album($album_id, $current_video->id, $config['per_page'], $off_set);
            $this->pagination->initialize($config);
            $this->_data['pagination'] = $this->pagination->create_links();
            $this->_data['page_title'] = "Liste video";
            $this->_data['perpage'] = $per_page;
            $this->_data['offset'] = $off_set;
            $this->_data['album_id'] = $album_id;

            
            $this->display_view('home/gallerie/video_album_details');
                
      } 
    
      
      
  }
?>
