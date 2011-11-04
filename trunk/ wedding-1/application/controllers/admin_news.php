<?php

class Admin_news extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('News_m');
        $this->_data['sidebar'] = "news";
    }

    function index() {
        is_admin();
        $this->list_news();
    }

    function list_news() {
        is_admin();
        $per_page = $this->uri->segment(3);
        if ($per_page == "") {
            $per_page = 8;
        }
        $off_set = $this->uri->segment(4);
        if ($off_set == "") {
            $off_set = 0;
        }
        $config['full_tag_open'] = "<div id='wrapperpage'>";
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<span id="pageactive"> ';
        $config['cur_tag_close'] = ' </span>';
        $config['next_link'] = 'Suiv.';
        $config['prev_link'] = 'Prec.';
        $config['base_url'] = base_url() . 'index.php/admin_news/list_news/' . $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->News_m->count_news();
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['query'] = $this->News_m->get_news($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste actualités";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_admin('admin/news/list_news');
    }

    function add_news() {
        is_admin();
        $config = array(
            array(
                'field' => 'title',
                'label' => 'tiêu đề',
                'rules' => 'required'
            ),
            array(
                'field' => 'content',
                'label' => 'nội dung',
                'rules' => 'required'
            ),
           
            array(
                'field' => 'catid',
                'label' => 'Categorie',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'mô tả',
                'rules' => 'required|xss_clean'
                )      
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $image_path = './assets/images/news';
                $thumb_path = $image_path . '/thumbs';
                $config = array(
                    'allowed_types' => "jpg|jpeg|gif|png",
                    'upload_path' => $image_path,
                    'max_size' => 2000,
                    'encrypt_name' => true
                );
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload()) {
                    $data = array(
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'catid' => $this->input->post('catid'),
                        'content' => $this->input->post('content'),
                        'posted' => time(),
                    	'available'=> $this->input->post("status"),
                    	'user_post'=> $this->session->userdata('user_id')
                    );
                    $query = $this->News_m->add_news($data);
                    if ($query)
                        $this->session->set_flashdata('error', "Thêm tin tức thành công !");
                    else
                        $this->session->set_flashdata('error', "Thêm tin tức thất bại !");
                    redirect('admin_news/list_news');
                } else {

                    $upload_info = $this->upload->data();
                    $config = array(
                        'source_image' => $upload_info['full_path'], //get original image
                        'new_image' => $thumb_path, //save as new image //need to create thumbs first
                        'maintain_ratio' => false,
                        'width' => 200,
                        'height' => 150
                    );
                    $this->load->library('image_lib', $config); //load library
                    $this->image_lib->resize(); //do whatever specified in config
                    $data = array(
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'), 
                        'catid' => $this->input->post('catid'),
                        'img' => $upload_info['file_name'],
                        'content' => $this->input->post('content'),
                        'posted' => time(),
                    	'available'=> $this->input->post("status"),
                    	'user_post'=> $this->session->userdata('user_id')
                    );
                    $query = $this->News_m->add_news($data);
                    if ($query)
                        $this->session->set_flashdata('error', "Thêm tin tức thành công !");
                    else
                        $this->session->set_flashdata('error', "Thêm tin tức thất bại !");
                    redirect('admin_news/list_news');
                }
            }
        }


        $this->display_admin('admin/news/add_news');
    }

    function update_news($id="", $perpage="", $offset="") {
        is_admin();
         
        if($this->_data['query'] = $this->News_m->get_detail_news($id) === FALSE){
            redirect(site_url('Admin_news'));
        }
        $config = array(
            array(
                'field' => 'title',
                'label' => 'tiêu đề',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'content',
                'label' => 'nội dung',
                'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'description',
                'label' => 'Chú thích',
                'rules' => 'required|xss_clean'
            )
          
            
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $image_path = './assets/images/news';
                $thumb_path = $image_path . '/thumbs';
                $config = array(
                    'allowed_types' => "jpg|jpeg|gif|png",
                    'upload_path' => $image_path,
                    'max_size' => 2000,
                    'encrypt_name' => true
                );
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload()) {
                    $data = array(
                        'title' => $this->input->post('title'),
                        'catid' => $this->input->post('catid'),
                        'content' => $this->input->post('content'),
                        'description'=> $this->input->post('description'),
                        'available' => $this->input->post('available'),
                       
                    );
                    $query = $this->News_m->update_news($data, $id);
                    if ($query)
                        $this->session->set_flashdata('error', "Bài viết được sửa thành công !");
                    else
                        $this->session->set_flashdata('error', "Sửa bài viết thất bại !");
                    redirect('admin_news/list_news/' . $perpage . '/' . $offset);
                } else {
                    $query = $this->News_m->get_detail_news($id)->row();
                    if (!empty($query)) {
                        $info = $query;
                        if ($info->img != null) {
                            $image_to_delete = './assets/images/news' . $info->img;
                            $thumb_to_delete = './assets/images/news/thumbs/' . $info->img;
                            delete_images($image_to_delete, $thumb_to_delete);
                        }
                    }
                    $upload_info = $this->upload->data();
                    $config = array(
                        'source_image' => $upload_info['full_path'], //get original image
                        'new_image' => $thumb_path, //save as new image //need to create thumbs first
                        'maintain_ratio' => true,
                        'width' => 300,
                        'height' => 200
                    );
                    $this->load->library('image_lib', $config); //load library
                    $this->image_lib->resize(); //do whatever specified in config
                    $data = array(
                        'title'      => $this->input->post('title'),
                        'catid'      => $this->input->post('catid'),
                        'img'        => $upload_info['file_name'],
                        'description'=> $this->input->post('description'),
                        'available'  => $this->input->post('available'),
                        'content'    => $this->input->post('content'),
                      
                    );
                    $query = $this->News_m->update_news($data, $id);
                    if ($query)
                        $this->session->set_flashdata('error', "Bài viết được sửa thành công !");
                    else
                        $this->session->set_flashdata('error', "Sửa bài viết thất bại !");
                    redirect('admin_news/list_news/' . $perpage . '/' . $offset);
                }
            }
        }
        $this->_data['categorie'] = $this->News_m->get_cat_limit($perpage, $offset);
        $this->_data['query'] = $this->News_m->get_detail_news($id)->row();
        $this->_data['perpage'] = $perpage;
        $this->_data['offset'] = $offset;

        $this->display_admin('admin/news/update_news');
    }

    function delete_news($id, $perpage, $offset) {
        is_admin();
        $news = $this->News_m->get_detail_news($id);
        if ($news->num_rows() > 0) {
            if ($news->row()->img != null) {
                $image_to_delete = './assets/photo_news/' . $news->row()->img;
                $thumb_to_delete = './assets/photo_news/thumbs/' . $news->row()->img;
                delete_images($image_to_delete, $thumb_to_delete);
            }
        }
        $query = $this->News_m->delete_news($id);
        if ($query)
            $this->session->set_flashdata('error', "L'article a été supprimé !");
        else
            $this->session->set_flashdata('error', "L'article n'a pas été supprimé !");
        redirect('admin_news/list_news/' . $perpage . '/' . $offset);
    }

    function delete_multi_news($perpage, $offset) {
        is_admin();
        $list = "";
        $adelete = $this->input->post('delete');
        $N = count($adelete);

        for ($i = 0; $i < $N; $i++) {
            if ($adelete[$i] != "") {
                $list = $list . ',' . $adelete[$i];
                $news = $this->News_m->get_detail_news($adelete[$i]);

                if ($news->num_rows() > 0) {
                    if ($news->row()->img != null) {
                        $image_to_delete = './assets/photo_news/' . $news->row()->img;
                        $thumb_to_delete = './assets/photo_news/thumbs/' . $news->row()->img;
                        delete_images($image_to_delete, $thumb_to_delete);
                    }
                }
            }
        }
        $list = '(' . substr($list, 1) . ')';

        $query = $this->News_m->delete_multi_news($list);
        if ($query)
            $this->session->set_flashdata('error', "L'article a été supprimé !");
        else
            $this->session->set_flashdata('error', "L'article n'a pas été supprimé !");
        redirect('admin_news/list_news/' . $perpage . '/' . $offset);
    }

    function list_cat() {
        is_admin();
        $per_page = $this->uri->segment(3);
        if ($per_page == "") {
            $per_page = 8;
        }
        $off_set = $this->uri->segment(4);
        if ($off_set == "") {
            $off_set = 0;
        }
        $config['full_tag_open'] = "<div id='wrapperpage'>";
        $config['full_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<span id="pageactive"> ';
        $config['cur_tag_close'] = ' </span>';
        $config['next_link'] = 'Suiv.';
        $config['prev_link'] = 'Prec.';
        $config['base_url'] = base_url() . 'index.php/admin_news/list_cat/' . $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->db->count_all('cat_news');
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }

        $this->_data['query'] = $this->News_m->get_cat_limit($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste de page";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_admin('admin/news/list_cat');
    }
    
    function add_cat() {
        is_admin();
        $config = array(
            array(
                'field' => 'title',
                'label' => 'Tên của danh mục',
                'rules' => 'required|xss_clean'
            ),
             array(
                'field' => 'description',
                'label' => 'Chú thích',
                'rules' => 'xss_clean'
            ),
            
            array(
                'field' => 'meta_title',
                'label' => 'Meta Title',
                'rules' => 'xss_clean'
            ),
            
            array(
                'field' => 'meta_description',
                'label' => 'Meta Description',
                'rules' => 'xss_clean'
            )
            
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run() === TRUE) {
            	$image_path = './assets/images/news_category';
                $thumb_path = $image_path . '/thumbs';
                $config = array(
                    'allowed_types' => "jpg|jpeg|gif|png",
                    'upload_path' => $image_path,
                    'max_size' => 2000,
                    'encrypt_name' => true
                );
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload()) {
	                $data = array(
	                    'name' => $this->input->post('title'),
	                	'description' => $this->input->post('description'),
	                    'meta_title' => $this->input->post('meta_title'),
	                    'meta_description' => $this->input->post('meta_description')
	                );
                }else{
                	$upload_info = $this->upload->data();
                    $config = array(
                        'source_image' => $upload_info['full_path'], //get original image
                        'new_image' => $thumb_path, //save as new image //need to create thumbs first
                        'maintain_ratio' => false,
                        'width' => 200,
                        'height' => 150
                    );
                    $this->load->library('image_lib', $config); //load library
                    $this->image_lib->resize(); //do whatever specified in config	
                    $data = array(
                        'name' => $this->input->post('title'),
	                	'description' => $this->input->post('description'),
	                    'meta_title' => $this->input->post('meta_title'),
	                    'meta_description' => $this->input->post('meta_description'),
                        'img'        => $upload_info['file_name']
                       
                    );
                }
                $query = $this->News_m->add_cat($data);
                if ($query)
                    $this->session->set_flashdata('error', "Thêm danh mục thành công !");
                else
                    $this->session->set_flashdata('error', "Thêm danh mục thất bại !");
                redirect('admin_news/list_cat');
            }
        }
        $this->display_admin('admin/news/add_cat');
    }                                                 

    function update_cat($id='', $perpage='', $offset='') {
        is_admin();
        if($this->News_m->get_detail_cat($id) === FALSE){
            redirect(site_url('Admin_news/list_cat'));
        }
        $config = array(
            array(
                'field' => 'title',
                'label' => 'Tên của danh mục',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'Chú thích',
                'rules' => 'xss_clean'
            ),
            array(
                'field' => 'meta_title',
                'label' => 'Meta title',
                'rules' => 'xss_clean'
            ),
            array(
                'field' => 'meta_description',
                'label' => 'Meta description',
                'rules' => 'xss_clean'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $data = array(
                    'name' => $this->input->post('title'),
               		'description' => $this->input->post('description'),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description')
                );
                $query = $this->News_m->update_cat($data, $id);
                if ($query)
                    $this->session->set_flashdata('error', "Sửa thông tin của danh mục thành công !");
                else
                    $this->session->set_flashdata('error', "Sửa thông tin của danh mục thất bại !");
                redirect('admin_news/list_cat');
            }
        }
        $this->_data['query'] = $this->News_m->get_detail_cat($id);
        $this->_data['perpage'] = $perpage;
        $this->_data['offset'] = $offset;
        $this->display_admin('admin/news/update_cat');
    }

    function delete_cat($id, $perpage, $offset) {
        is_admin();
        $query = $this->News_m->delete_cat($id);
        if ($query)
            $this->session->set_flashdata('error', "Danh mục được xóa thành công !");
        else
            $this->session->set_flashdata('error', "Xóa danh mục thất bại !");
        redirect('admin_news/list_cat/' . $perpage . '/' . $offset);
    }
    
    
   
}

?>
