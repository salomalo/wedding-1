<?php

class Admin_club extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Club_m');
        $this->_data['sidebar'] = "club";
    }

    function index() {
        is_admin();
        $this->list_club();
    }

    function list_club() {
        is_admin();
        $per_page = $this->uri->segment(3);
        if ($per_page == "") {
            $per_page = 5;
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
        $config['base_url'] = base_url() . 'index.php/admin_club/list_club/' . $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->Club_m->count_club();
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['query'] = $this->Club_m->get_all_club($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste Club";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_admin('admin/club/list_club');
    }

    function add_club() {
        is_admin();
        $config = array(
            array(
                'field' => 'title',
                'label' => 'Titre',
                'rules' => 'required'
            ),
            array(
                'field' => 'content',
                'label' => 'Contenu',
                'rules' => 'required'
            ),
            array(
                'field' => 'catid',
                'label' => 'Categorie',
                'rules' => 'required'
            )

            
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $image_path = './assets/photo_club';
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
                        'cat_id' => $this->input->post('catid'),
                        'content' => $this->input->post('content'),
                    );
                    $query = $this->Club_m->add_club($data);
                    if ($query)
                        $this->session->set_flashdata('error', "L'article a été ajouté !");
                    else
                        $this->session->set_flashdata('error', "L'article n'est pas ajouté, veuillez reessayer !");
                    redirect('admin_club/list_club');
                } else {

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
                        'title' => $this->input->post('title'),
                        'cat_id' => $this->input->post('catid'),
                        'img' => $upload_info['file_name'],
                        'content' => $this->input->post('content'),
                    );
                    $query = $this->Club_m->add_club($data);
                    if ($query)
                        $this->session->set_flashdata('error', "L'article a été modifié!");
                    else
                        $this->session->set_flashdata('error', "L'article n'est pas modifié, veuillez reessayer !");
                    redirect('admin_club/list_club');
                }
            }
        }
        $this->display_admin('admin/club/add_club');
    }
    
    function update_club($id = null, $perpage, $offset){
        is_admin();
  
        //validate configs
        $config = array(
            array(
                'field' => 'title',
                'label' => 'Titre',
                'rules' => 'required'
            ),
            array(
                'field' => 'content',
                'label' => 'Contenu',
                'rules' => 'required'
            ),
            array(
                'field' => 'catid',
                'label' => 'Categorie',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        //-----------------------------------------//
        
        if($this->input->post("submit")){
            
            if($this->form_validation->run() === TRUE){
                //upload path
                $image_path = './assets/photo_club';
                $thumb_path = $image_path . '/thumbs';
                
                //upload configs
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '5000';
                $config['max_width'] = '1024';
                $config['max_height'] = '765';
                $config['encrypt_name'] = TRUE;
                
                //load library upload
                $this->load->library('upload', $config);
                
                //if image is not uploaded
                if(!$this->upload->do_upload()){
                    
                     $data = array(
                                  'title' => $this->input->post('title'),
                                  'cat_id' => $this->input->post('catid'),
                                  'content' => $this->input->post('content')
                                  );
                    $query = $this->Club_m->update_club($data, $id);
                    if ($query>0){
                        $this->session->set_flashdata('error', "L'article a été modifié!");   
                    }
                    else{
                         $this->session->set_flashdata('error', "L'article n'est pas modifié, veuillez reessayer !");   
                    }
                    redirect('admin_club/list_club/' . $perpage . '/' . $offset);        
                   
                    
                }else{ // if image is uploaded
                
                    $result = $this->Club_m->get_detail_club($id);
                    
                    //delete old image
                    $image = $result['img'];
                    
                    if ($image != null) {
                            $image_to_delete = './assets/photo_club/' . $image;
                            $thumb_to_delete = './assets/photo_club/thumbs/' . $image;
                            delete_images($image_to_delete, $thumb_to_delete);
                    }       
                    //-----------------------------------------------------
                    
                    $upload_data = $this->upload->data();
                    
                    $config = array(
                        'source_image' => $upload_data['full_path'], //get original image
                        'new_image' => $thumb_path, //save as new image //need to create thumbs first
                        'maintain_ratio' => true,
                        'width' => 300,
                        'height' => 200
                        
                    );
                    $this->load->library('image_lib', $config); //load library
                    $this->image_lib->resize(); //do whatever specified in config
                    
                    $data = array('img' => $upload_data['file_name'],
                                  'title' => $this->input->post('title'),
                                  'cat_id' => $this->input->post('catid'),
                                  'content' => $this->input->post('content')
                                  );
                    $query = $this->Club_m->update_club($data, $id);
                    if ($query>0){
                        $this->session->set_flashdata('error', "L'article a été modifié !");   
                    }
                    else{
                         $this->session->set_flashdata('error', "L'article n'est pas modifié, veuillez reessayer !");   
                    }
                    redirect('admin_club/list_club/' . $perpage . '/' . $offset);
                       
                }
            
            }
        }else{
            $this->_data['perpage'] = $perpage;
            $this->_data['offset'] = $offset;
            $this->_data['query'] = $this->Club_m->get_detail_club($id);
            $this->display_admin('admin/club/update_club');
            
        }
        
     
    }
    
    function delete_club($id, $perpage, $offset) {
        is_admin();
        $news = $this->Club_m->get_detail_club($id);
        if (!empty($news)) {
            if ($news['img'] != null) {
                $image_to_delete = './assets/photo_club/' . $news['img'];
                $thumb_to_delete = './assets/photo_club/thumbs/' . $news['img'];
                delete_images($image_to_delete, $thumb_to_delete);
            }
        }
        $query = $this->Club_m->delete_club($id);
        if ($query > 0)
            $this->session->set_flashdata('error', "L'article a été supprimé !");
        else
            $this->session->set_flashdata('error', "L'article n'a pas été supprimé !");
        redirect('admin_club/list_club/' . $perpage . '/' . $offset);
    }

    function delete_multi_club($perpage, $offset) {
        is_admin();
        $list = "";
        $adelete = $this->input->post('delete');
        $N = count($adelete);

        for ($i = 0; $i < $N; $i++) {
            if ($adelete[$i] != "") {
                $list = $list . ',' . $adelete[$i];
                $news = $this->Club_m->get_detail_club($adelete[$i]);
                if (!empty($news)) {
                    if ($news['img'] != null) {
                        $image_to_delete = './assets/photo_club/' . $news['img'];
                        $thumb_to_delete = './assets/photo_club/thumbs/' . $news['img'];
                        delete_images($image_to_delete, $thumb_to_delete);
                    }
                }
            }
        }
        $list = '(' . substr($list, 1) . ')';
        $query = $this->Club_m->delete_multi_club($list);

        if ($query > 0)
            $this->session->set_flashdata('error', "L'article a été supprimé !");
        else
            $this->session->set_flashdata('error', "L'article n'a pas été supprimé  !");
        redirect('admin_club/list_club/' . $perpage . '/' . $offset);
    }
    
    //------------------categories functions-------------------------------//
    function add_categories(){
        is_admin();
        $config = array(
            array(
                'field' => 'title',
                'label' => 'Nom',
                'rules' => 'required|xss_clean'
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
                $data = array(
                    'title' => $this->input->post('title'),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description')
                );
                $query = $this->Club_m->add_cat($data);
                if ($query)
                    $this->session->set_flashdata('error', "L'article a été ajouté !");
                else
                    $this->session->set_flashdata('error', "L'article n'est pas ajouté, veuillez reessayer !");
                redirect('admin_club/list_categories');
            }
        }
        $this->display_admin('admin/club/add_club_category');
    } 
    
    function list_categories(){
        is_admin();
        $per_page = $this->uri->segment(3);
        if ($per_page == "") {
            $per_page = '5';
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
        $config['base_url'] = base_url() . 'index.php/admin_club/list_categories/' . $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->db->count_all('cat_club');
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }

        $this->_data['query'] = $this->Club_m->get_cat_limit($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste de page";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_admin('admin/club/list_categories');
    }
    
    function update_categories($id, $perpage, $offset) {
        is_admin();
        $config = array(
            array(
                'field' => 'title',
                'label' => 'Nom',
                'rules' => 'required'
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
                    'title' => $this->input->post('title'),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description')
                );
                $query = $this->Club_m->update_cat($data, $id);
                if ($query)
                    $this->session->set_flashdata('error', "L'article a été modifié!");
                else
                    $this->session->set_flashdata('error', "L'article n'est pas modifié, veuillez reessayer !");
                redirect('admin_club/list_categories');
            }
        }
        $this->_data['query'] = $this->Club_m->get_detail_cat($id);
        $this->_data['perpage'] = $perpage;
        $this->_data['offset'] = $offset;
        $this->display_admin('admin/club/update_cat');
    }

    function delete_category($id, $perpage, $offset) {
        is_admin();
        $query = $this->Club_m->delete_cat($id);
        if ($query)
            $this->session->set_flashdata('error', "L'article a été supprimé !");
        else
            $this->session->set_flashdata('error', "L'article n'a pas été supprimé !");
        redirect('admin_club/list_categories/' . $perpage . '/' . $offset);
    }

    function delete_multi_cat($perpage, $offset) {
        is_admin();
        $list = "";
        $adelete = $this->input->post('delete');
        $N = count($adelete);
        for ($i = 0; $i < $N; $i++) {
            if ($adelete[$i] != ""

                )$list = $list . ',' . $adelete[$i];
        }
        $list = '(' . substr($list, 1) . ')';

        $query = $this->Club_m->delete_multi_cat($list);
        if ($query)
            $this->session->set_flashdata('error', "L'article a été supprimé !");
        else
            $this->session->set_flashdata('error', "L'article n'a pas été supprimé !");
        redirect('admin_club/list_categories/' . $perpage . '/' . $offset);
    }
    
    
    

}

?>
