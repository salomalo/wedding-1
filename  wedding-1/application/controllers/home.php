<?php
    class Home extends FrontEnd_Controller{
        function __contruct(){
            parent::__contruct();
            $this->load->model('Media_m');
            $this->load->Model('News_m'); 
        }
        
        function index($id=null){
            $this->display_view('home/index');    
     
        }
        
        function video($id){
           /* $this->_data['news_home'] = $this->News_m->get_news_home();
            $this->_data['videos'] = $this->Media_m->get_feature_video_link(); 
            $this->_data['lastest_videos'] = $this->Media_m->get_lastest_feature_video_link();
            */
            $this->_data['lastest_album'] = $this->Media_m->get_photo_albums(4,0);
            $video_play = $this->_data['video_play'] = $this->Media_m->get_video_play_home($id);
            $this->_data['other_videos'] = $this->Media_m->get_other_video_home($video_play->id);
            $this->display_view('home/index');
            
        }
        
        
    }
?>
