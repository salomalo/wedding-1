<?php
  class Club extends Club_Controller{
      public function __construct(){
          parent :: __construct();
          $this->load->model('Club_m');
      }
      
      public function index(){
          $this->club();   
      }
      
      public function club(){
        $per_page = $this->uri->segment(4);
        if ($per_page == "") {
            $per_page = 8;
        }
        $off_set = $this->uri->segment(5);
        if ($off_set == "") {
            $off_set = 0;
        }
        /*$config['full_tag_open'] = "<div id='wrapperpage'>";
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<span id="pageactive"> ';
        $config['cur_tag_close'] = ' </span>';     */
        $config['next_link'] = 'Suiv.';
        $config['prev_link'] = 'Prec.';
        $config['base_url'] = base_url() . 'index.php/club/club/' . $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 5;
        $config['total_rows'] = $this->Club_m->count_club();
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['club_list'] = $this->Club_m->get_all_clubs($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste club";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_view('home/club/club_list');
             
      }   
      
      public function club_content($id = 0){
          $result = $this->Club_m->get_club_content($id);
          if($result === FALSE){
              redirect('/');
          }else{
              $this->_data['club_content'] = $result;
              $this->display_view('home/club/club_content');
          }
          
      }                        
      
      public function club_by_category($id = 0){
        $per_page = $this->uri->segment(5);
        if ($per_page == "") {
            $per_page = 8;
        }
        $off_set = $this->uri->segment(6);
        if ($off_set == "") {
            $off_set = 0;
        }
        /*$config['full_tag_open'] = "<div id='wrapperpage'>";
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<span id="pageactive"> ';
        $config['cur_tag_close'] = ' </span>';     */
        $config['next_link'] = 'Suiv.';
        $config['prev_link'] = 'Prec.';
        $config['base_url'] = base_url() . 'index.php/club/club_by_category/'.$id.'/' . $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 6;
        $config['total_rows'] = $this->Club_m->count_club_by_category($id);
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        if($this->Club_m->get_club_by_category($id, $config['per_page'], $off_set) === FALSE){
            redirect('/');
        }
        $this->_data['club_list'] = $this->Club_m->get_club_by_category($id, $config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste Club";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_view('home/club/club_list');    
      }
  }
?>
