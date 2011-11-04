<?php

class MY_Controller extends CI_Controller {

    var $_data = FALSE;
    var $container = 'container';

    public function __construct() {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->load->helper('text');
        $this->load->model('Club_m');
        $this->load->model('Admin_m');
        
    }

    function display_view($path) {
        $this->before_render();
        $this->_data['load_path'] = $path;
        $this->load->view($this->container, $this->_data);
    }

    function display_admin($path) {
        $this->before_render();
        $this->_data['load_path'] = $path;
        $this->load->view('admin/container', $this->_data);
    }

    function before_render() {
        
    }

}

class FrontEnd_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $header['page'] = 'home/header';
        $footer['page'] = "home/footer";
        $sidebar['page'] = "home/side_bar";
        $this->_data['sidebar'] = $sidebar;
        $this->_data['footer'] = $footer;
        $this->_data['header'] = $header;
        $this->load->Model('News_m');
        $this->load->Model('Media_m');
    }
    
    function display_view($path) {
        $this->before_render();
        $this->_data['load_path'] = $path;
        $this->load->view('home/container', $this->_data);
    }
    
    function before_render() {
        $this->_data['news_home'] = $this->News_m->get_news_home();
        $this->_data['videos'] = $this->Media_m->get_feature_video_link(); 
        $this->_data['lastest_videos'] = $this->Media_m->get_lastest_feature_video_link();
        $this->_data['lastest_album'] = $this->Media_m->get_photo_albums(4,0);
            
    }
  

}

class Admin_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $header['page'] = 'admin/header';
        $footer['page'] = "admin/footer";
        $this->_data['footer'] = $footer;
        $this->_data['header'] = $header;
    }

    function before_render() {
        $this->_data['sidebar_présentation'] = $this->Club_m->get_club_by_kind('présentation');
        $this->_data['sidebar_danse'] = $this->Club_m->get_club_by_kind('danse');
        $this->_data['sidebar_cusine'] = $this->Club_m->get_club_by_kind('cusine');
    }

}

class News_Controller extends FrontEnd_Controller{
    
    public function __construct(){
        parent :: __construct();
        $sidebar['page'] = "home/news/news_sidebar";
        $this->_data['sidebar'] = $sidebar;
        $this->load->Model('News_m');
        
        
    }
    
    function display_view($path) {
        $this->before_render();
        $this->_data['load_path'] = $path;
        $this->load->view('home/news/news_container', $this->_data);
    }
    
    function before_render() {
        $this->_data['categories'] = $this->News_m->get_categories_home();
    }
}

class Club_Controller extends FrontEnd_Controller{
    
    public function __construct(){
        parent :: __construct();
        $sidebar['page'] = "home/club/club_sidebar";
        $this->_data['sidebar'] = $sidebar;
        $this->load->Model('Club_m');
        
    }
    
    function display_view($path) {
        $this->before_render();
        $this->_data['load_path'] = $path;
        $this->load->view('home/club/club_container', $this->_data);
    }
    
    function before_render() {
        $this->_data['cat_list'] = $this->Club_m->get_club_categories();
        
    }
} 

class Gallerie_Controller extends FrontEnd_Controller{
    
    public function __construct(){
        parent :: __construct();
        $sidebar['page'] = "home/gallerie/gallerie_sidebar";
        $this->_data['sidebar'] = $sidebar;
        $this->load->Model('Media_m');
        
    }
    
    function display_view($path) {
        $this->before_render();
        $this->_data['load_path'] = $path;
        $this->load->view('home/gallerie/gallerie_container', $this->_data);
    }
    
    function before_render() {
        //$this->_data['cat_list'] = $this->Club_m->get_club_categories();
        
    }
}

?>