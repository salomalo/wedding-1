<?php
  class Tintuc extends News_Controller{
      public function __construct(){
          parent :: __construct();
          $this->load->model('News_m');
      }
      
      function index(){
          
          $this->tintuc();
      }
      
      function tintuc(){
        $this->_data['page_title'] = "Tin tức";
        $per_page = $this->uri->segment(3);
        if ($per_page == "") {
            $per_page = 4;
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
        $config['base_url'] = base_url() . 'index.php/news/news/' . $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->News_m->count_avaiable_news();
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['list_news'] = $this->News_m->get_available_news($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste actualités";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_view('home/news/news_list');
      }
      
      function danh_muc(){
        
        $per_page = $this->uri->segment(3);
        if ($per_page == "") {
            $per_page = 3;
        }
        $off_set = $this->uri->segment(4);
        if ($off_set == "") {
            $off_set = 0;
        }
        
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['base_url'] = base_url() . 'index.php/tintuc/danh_muc/'.$per_page;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->News_m->count_news_category();
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['list_news'] = $this->News_m->get_cat_limit($config['per_page'], $off_set);
        if(!$this->_data['list_news']){
            redirect(site_url('news'));
        }
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Các danh mục tin tức";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_view('home/news/danhmuc');    
      }
      
    function tin_tuc_theo_danh_muc($id){
        $current_views = $this->News_m->get_current_cat_views($id)->total_views;
        $new_views = $current_views + 1;
        $this->News_m->update_cat_views($id, array("total_views" => $new_views));
        $per_page = $this->uri->segment(4);
        if ($per_page == "") {
            $per_page = 3;
        }
        $off_set = $this->uri->segment(5);
        if ($off_set == "") {
            $off_set = 0;
        }
        
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['base_url'] = base_url() . 'index.php/tintuc/tin_tuc_theo_danh_muc/'.'/'.$id.'/'.$per_page;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 5;
        $config['total_rows'] = $this->News_m->count_news_by_category_id($id);
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['list_news'] = $this->News_m->get_news_of_category_limit($id, $config['per_page'], $off_set);
        
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Các danh mục tin tức";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_view('home/news/tintucdanhmuc');    
      }
      
      function noi_dung_tin_tuc($id = null){
          $this->_data['news_content'] = $this->News_m->get_news_content($id);
          if($this->_data['news_content'] === FALSE){
               redirect('/');   
          }
          $this->display_view('home/news/noidungtintuc');
      }
  }
?>
