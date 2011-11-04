<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_media
 *
 * @author Gidaff_01
 */
class Admin_media extends Admin_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Media_m');
        $this->_data['sidebar'] = 'admin_media';
    }

    function index() {
        is_admin();
        $this->list_media();
    }
    
   
    function list_media($kind='image') {
        is_admin();
        $this->session->set_userdata('current_url', current_url());
        $this->_data['kind'] = $kind;
        $per_page = $this->uri->segment(4);
        if ($per_page == "") {
            $per_page = 5;
        }
        $off_set = $this->uri->segment(5);
        if ($off_set == "") {
            $off_set = 0;
        }
        $config['base_url'] = base_url() . 'index.php/admin_media/list_media' . '/' . $kind . '/' . $per_page . '/';
        $config['per_page'] = '5';
        $config['uri_segment'] = 5;
        $config['total_rows'] = $this->Media_m->count_media($kind);
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['images'] = $this->Media_m->get_all_medias($kind, $config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['total'] = $this->Media_m->count_media($kind);
        $this->_data['per_page'] = $per_page;
        $this->_data['off_set'] = $off_set;
        $this->_data['kind'] = $kind;
        $this->display_admin('admin/media/list_media');
    }

    function list_media_by_album($album_id, $kind) {
        is_admin();
        $this->session->set_userdata('current_url', current_url());
        $per_page = $this->uri->segment(5);
        if ($per_page == "") {
            $per_page = 7;
        }
        $off_set = $this->uri->segment(6);
        if ($off_set == "") {
            $off_set = 0;
        }
        $config['base_url'] = base_url() . 'index.php/admin_media/list_media_by_album' . '/' . $album_id . '/' . $kind . '/' . $per_page . '/';
        $config['per_page'] = '7';
        $config['uri_segment'] = 6;
        $config['total_rows'] = $this->Media_m->count_media_by_album($album_id);
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['images'] = $this->Media_m->get_all_medias_by_album($album_id, $kind, $config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['total'] = $this->Media_m->count_media_by_album($album_id);
        $this->_data['per_page'] = $per_page;
        $this->_data['off_set'] = $off_set;
        $this->_data['kind'] = $kind;
        $this->display_admin('admin/media/list_media');
    }

    function add_video() {
        is_admin();
        $this->session->set_userdata('current_url', current_url());
        $config = array(
            array(
                'field' => 'title',
                'label' => 'Titre',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            ),
            array(
                'field' => 'video_link',
                'label' => 'Video link',
                'rules' => 'required'
            ),
            array(
                'field' => 'available',
                'label' => 'Video available',
                'rules' => 'trim'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $file_path =  $this->input->post('video_link');              
                $video_available =  $this->input->post('available');              
                $query = $this->Media_m->add_media(array('file_path' => $file_path), 'video', $video_available);
                if ($query > 0)
                    $this->session->set_flashdata('error', lang('add') . ' ' . lang('success'));
                else
                    $this->session->set_flashdata('error', lang('add') . ' ' . lang('fail'));
                redirect('admin_media/list_media/video');
            }else {
                $this->display_admin('admin/media/add_video');
            }
        } else {
            $this->display_admin('admin/media/add_video');
        }
    }

    function delete_media($id, $kind, $perpage, $offset) {
        is_admin();
        $media = $this->Media_m->get_detail_media($id);
        if ($kind == 'video') {
            $file_name = './assets/media/videos/' . $media['file_path'];
            if ($media['file_path'] != null) {
                delete_my_file($file_name);
            }
        } else {
            $file_name = './assets/media/images/' . $media['file_path'];
            $thumbs_name = './assets/media/images/thumbs/' . $media['file_path'];
            if ($media['file_path'] != null) {
                delete_images($file_name, $thumbs_name);
            }
        }

        $query = $this->Media_m->delete_media($id);
        if ($query)
            $this->session->set_flashdata('error', lang('delete').' ' . lang('success'));
        else
            $this->session->set_flashdata('error', lang('delete') . ' '.lang('fail'));
        redirect('admin_media/list_media/' . $kind . '/' . $perpage . '/' . $offset);
    }

    function delete_multi_medias($kind, $perpage, $offset) {
        is_admin();
        $list = "";
        $adelete = $this->input->post('delete');
        $N = count($adelete);
        for ($i = 0; $i < $N; $i++) {
            $media = $this->Media_m->get_detail_media($adelete[$i]);
            if ($kind == 'video') {
                $file_name = './assets/media/videos/' . $media['file_path'];
                if ($media['file_path'] != null) {
                    delete_my_file($file_name);
                }
            } else {
                $file_name = './assets/media/images/' . $media['file_path'];
                $thumbs_name = './assets/media/images/thumbs/' . $media['file_path'];
                if ($media['file_path'] != null) {
                    delete_images($file_name, $thumbs_name);
                }
            }
            if ($adelete[$i] != "")
                $list = $list . ',' . $adelete[$i];
        }
        $list = '(' . substr($list, 1) . ')';

        $query = $this->Media_m->delete_medias($list);
        if ($query)
            $this->session->set_flashdata('error', lang('delete').' ' . lang('success'));
        else
            $this->session->set_flashdata('error', lang('delete').' ' . lang('fail'));
        redirect('admin_media/list_media/' . $kind . '/' . $perpage . '/' . $offset);
    }

    function update_media($id, $kind, $perpage, $offset) {
        is_admin();
        $media = $this->_data['query'] = $this->Media_m->get_detail_media($id);
        
        $this->_data['per_page'] = $perpage;
        $this->_data['off_set'] = $offset;
        $this->_data['kind'] = $kind;
        
        $config = array(
                        array('field' => 'title',
                              'label' => 'Titre',
                              'rules' => 'required| trim| xss_clean'
                             ),
                             
                         array('field' => 'description',
                              'label' => 'Description',
                              'rules' => 'required| trim| xss_clean'
                             ),
                             
                        array('field' => 'video_link',
                              'label' => 'Video link',
                              'rules' => 'required'
                             )
                      
                       ) ;
        $this->form_validation->set_rules($config);
        
        
        if ($this->input->post('submit')) {
            if($this->form_validation->run()){
                
                $title = $this->input->post('title');
                $description = $this->input->post('description');
                $video_link = $this->input->post('video_link');
                $available = $this->input->post('available');
                $album = $this->input->post('album_id');
                
                
                $data = array('file_path' => $video_link,
                              'album_id'  => $album,
                               'title'    => $title,
                               'description' => $description,
                               'available' => $available 
                              );
                
                $query = $this->Media_m->update_media($id, $data);
                if ($query)
                    $this->session->set_flashdata('error', lang('update') .' '. lang('success'));
                else
                    $this->session->set_flashdata('error', lang('update').' ' . lang('fail'));
                redirect('admin_media/list_media/' . $kind . '/' . $perpage . '/' . $offset);   
            }else{
                $this->display_admin('admin/media/update_media');
            }
      
        } else {
            $this->display_admin('admin/media/update_media');
        }
    }
    
    function update_image($id, $kind, $perpage, $offset){
        is_admin();
        $media = $this->_data['query'] = $this->Media_m->get_detail_media($id);
        
        $this->_data['per_page'] = $perpage;
        $this->_data['off_set'] = $offset;
        $this->_data['kind'] = $kind;
        
        
        $config = array(
            array(
                'field' => 'title',
                'label' => lang('title'),
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => lang('description'),
                'rules' => 'required'
            )
        );               
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
                if($this->form_validation->run()){
                     $image_path = './assets/media/images';
                     $thumb_path = $image_path . '/thumbs';
                     $config = array(
                                    'allowed_types' => "jpg|jpeg|gif|png",
                                    'upload_path' => $image_path,
                                    'max_size' => 10000,
                                    'encrypt_name' => TRUE
                                     ); 
                     $this->load->library('upload', $config);
                     if (!$this->upload->do_upload()) {   
                         $data = array(
                            'title' => $this->input->post('title'),
                            'description' => $this->input->post('description'),
                            'album_id' => $this->input->post('album_id'),
                            );
                         $query = $this->Media_m->update_media($id, $data);
                         if ($query)
                            $this->session->set_flashdata('error', "L'image a été modifié !");
                            else
                            $this->session->set_flashdata('error', "L'image n'est pas modifié, veuillez reessayer !");
                        redirect('admin_media/list_media/' . $kind . '/' . $perpage . '/' . $offset);  
                     }else {
                         
                        $query = $this->Media_m->get_detail_media($id); 
                        if (!empty($query)) {
                            $info = $query;
                            if ($info['file_path'] != null) {
                                $image_to_delete = './assets/media/images/' . $info['file_path'];
                                $thumb_to_delete = './assets/media/images/thumbs/' . $info['file_path'];
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
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'album_id' => $this->input->post('album_id'),
                        'file_path' => $upload_info['file_name']
                     
                    );
                    $query = $this->Media_m->update_media($id, $data);
                    if ($query)
                        $this->session->set_flashdata('error', "L'article a Ã©tÃ© modifiÃ© !");
                    else
                        $this->session->set_flashdata('error', "L'article n'est pas modifiÃ©, veuillez reessayer !");
                    redirect('admin_media/list_media/' . $kind . '/' . $perpage . '/' . $offset);
                }
            }
        }
        
        $this->display_admin('admin/media/update_image');
     
    }

    function list_albums() {
        is_admin();
        $this->session->set_userdata('current_url', current_url());
        $per_page = $this->uri->segment(3);
        if ($per_page == "") {
            $per_page = 4;
        }
        $off_set = $this->uri->segment(4);
        if ($off_set == "") {
            $off_set = 0;
        }
        $config['base_url'] = base_url() . 'index.php/admin_media/list_albums/' . $per_page . '/';
        $config['per_page'] = '6';
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->Media_m->count_album();
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['albums'] = $this->Media_m->get_all_albums($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['total'] = $this->Media_m->count_album();
        $this->_data['per_page'] = $per_page;
        $this->_data['off_set'] = $off_set;
        $this->display_admin('admin/media/list_albums');
    }

    function add_album() {
        is_admin();
        $this->session->set_userdata('current_url', current_url());
        $config = array(
            array(
                'field' => 'title',
                'label' => 'Tirte',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $data = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'kind' => $this->input->post('kind')
                );
                $this->Media_m->add_album($data);
                $this->session->set_flashdata('error', 'Ajouter un nouveau succÃ¨s');
                redirect('admin_media/list_albums');
            }
            $this->display_admin('admin/media/add_album');
        }
        $this->display_admin('admin/media/add_album');
    }

    function delete_multi_album($id='') {
        is_admin();
        $list = "";
        $adelete = $this->input->post('delete');
        $N = count($adelete);
        for ($i = 0; $i < $N; $i++) {
            $media = $this->Media_m->get_media_by_album($adelete[$i]);
            foreach ($media as $m) {
                if ($m['kind'] == 'video') {
                    $file_name = './assets/media/videos/' . $m['file_path'];
                    if ($m['file_path'] != null) {
                        delete_my_file($file_name);
                    }
                } else {
                    $file_name = './assets/media/images/' . $m['file_path'];
                    $thumbs_name = './assets/media/images/thumbs/' . $m['file_path'];
                    if ($m['file_path'] != null) {
                        delete_images($file_name, $thumbs_name);
                    }
                }
            }
            if ($adelete[$i] != "")
                $list = $list . ',' . $adelete[$i];
        }
        $list = '(' . substr($list, 1) . ')';
        $query = $this->Media_m->delete_albums($list);
        if ($query)
            $this->session->set_flashdata('error', 'Supprimer le succÃ¨s');
        else
            $this->session->set_flashdata('error', 'Supprimer Ã©chouÃ©');

        redirect('admin_media/list_albums');
    }

    function delete_album($id, $kind) {
        is_admin();
        $media = $this->Media_m->get_media_by_album($id);
        foreach ($media as $m) {
            if ($kind == 'video') {
                $file_name = './assets/media/videos/' . $m['file_path'];
                if ($m['file_path'] != null) {
                    delete_my_file($file_name);
                }
            } else {
                $file_name = './assets/media/images/' . $m['file_path'];
                $thumbs_name = './assets/media/images/thumbs/' . $m['file_path'];
                if ($m['file_path'] != null) {
                    delete_images($file_name, $thumbs_name);
                }
            }
        }
        $query = $this->Media_m->delete_album($id);
        if ($query > 0) {
            $this->session->set_flashdata('error', 'Supprimer le succÃ¨s');
        }
        redirect('admin_media/list_albums');
    }

    function edit_album($id) {
        is_admin();
        $this->session->set_userdata('current_url', current_url());
        $query = $this->Media_m->get_album_by_id($id);
        $this->_data['query'] = $query;
        $config = array(
            array(
                'field' => 'title',
                'label' => lang('title'),
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => lang('description'),
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $data = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description')
                );
                $this->Media_m->update_album($data, $id);
                $this->session->set_flashdata('error', lang('update').' '.  lang('success'));
                redirect('admin_media/list_albums');
            }
            $this->display_admin('admin/media/edit_album');
        }
        $this->display_admin('admin/media/edit_album');
    }

    //MULTI IMAGES
    function add_images() {
        is_admin();
        $this->session->set_userdata('current_url', current_url());
        $config = array(
            array(
                'field' => 'title',
                'label' => lang('title'),
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => lang('description'),
                'rules' => 'required'
            )
        );               
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
           
                $image_path = './assets/media/images';
                $thumb_path = $image_path . '/thumbs';
                $config = array(
                    'allowed_types' => "jpg|jpeg|gif|png",
                    'upload_path' => $image_path,
                    'max_size' => 10000,
                    'encrypt_name' => TRUE
                );
               $this->load->library('upload',$config);
                $this->load->library('Multi_upload'); 
                $this->upload->initialize($config);
                
                $files = $this->multi_upload->go_upload();
                
                if (!$files) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin_media/add_images');
                } else {
                    $this->load->library('image_lib');
                    for ($i = 0; $i < count($files); $i++) {
                        $config = array(
                            'source_image' => $files[$i]['file'], //get original image
                            'new_image' => $thumb_path, //save as new image //need to create thumbs first
                            'maintain_ratio' => true,
                            'width' => 120,
                            'height' => 80
                        );
                        $this->image_lib->initialize($config);  //load library
                        $this->image_lib->resize();

                        $config1 = array(
                            'source_image' => $files[$i]['file'], //get original image
                            'new_image' => $image_path, //save as new image //need to create thumbs first
                            'maintain_ratio' => true,
                            'width' => 1024,
                            'height' => 768
                        );
                        $this->image_lib->initialize($config1);  //load library
                        $this->image_lib->resize();

                        $query = $this->Media_m->add_media(array('file_path' => $files[$i]['name']), 'image');
                    }

                    $data = array('upload_data' => $files);
                    if ($query) {
                        $this->session->set_flashdata('error', 'Upload'.' ' . lang('success'));
                    } else {
                        $this->session->set_flashdata('error', 'Upload'.' ' . lang('fail'));
                    }
                    redirect('admin_media/list_media/image');
                }
           
        } else {
            $this->display_admin('admin/media/add_images');
        }
    }  
    
  

}

