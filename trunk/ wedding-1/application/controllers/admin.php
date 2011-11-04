<?php

class Admin extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Admin_m');
        $this->_data['sidebar'] = 'admin';
    }

    function index() {
        $this->list_admin();
    }

    function login() {
        if ($this->session->userdata('user_id') && $this->session->userdata('group_id')) {
            redirect('admin_news');
        }
        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $email = $this->input->post('email');
                $password = md5($this->input->post('password'));
                if ($this->Admin_m->is_banned_admin($email) == FALSE) {
                    if ($this->Admin_m->login($email, $password)) {
                        redirect('admin_news');
                    } else {
                        $data['error'] = lang('error_login');
                        $this->load->view('admin/login', $data);
                    }
                } else {
                    $data['error'] = lang('banned');
                    $this->load->view('admin/login', $data);
                }
            } else {
                $this->load->view('admin/login');
            }
        } else {
            $this->load->view('admin/login');
        }
    }

    public function logout() {
        $this->Admin_m->logout();
        redirect('admin');
    }

    public function edit_profile($user_id='') {
        is_admin();
        $this->session->set_userdata('current_url', current_url());
        $birthday = $this->input->post('birth_year') . '-' . $this->input->post('birth_month') . '-' . $this->input->post('birth_date') . ' ' . date('H:i', time());
        $dob_long = human_to_unix($birthday);
        $admin = $this->Admin_m->get_admin_details($user_id);
        $this->_data['admin_data'] = $admin;
        if($this->Admin_m->get_admin_details($user_id) === FALSE){
            redirect(site_url('admin'));
        }
        
        $config = array(
            array(
                'field' => 'display_name',
                'label' => lang('display_name'),
                'rules' => 'required'
            ),
            array(
                'field' => 'first_name',
                'label' => lang('first_name'),
                'rules' => 'required'
            ),
            array(
                'field' => 'last_name',
                'label' => lang('last_name'),
                'rules' => 'required'
            ),
            array(
                'field' => 'phone',
                'Label' => lang('phone'),
                'rules' => 'min_length[10]'
            ),
            array(
                'field' => 'mobile',
                'Label' => lang('mobile'),
                'rules' => 'min_length[10]'
            ),
            array(
                'field' => 'mobile',
                'Label' => lang('mobile'),
                'rules' => 'min_length[10]'
            ),
            array(
                'field' => 'company',
                'Label' => lang('company'),
                'rules' => 'xss_clean'
            ),
            array(
                'field' => 'gender',
                'Label' => lang('gender'),
                'rules' => 'required'
            )
            
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('edit_profile')) {
            if ($this->form_validation->run()) {
                $image_path = './assets/admin/avatar';
                $thumb_path = $image_path . '/images';
                $config = array(
                    'allowed_types' => "jpg|jpeg|gif|png",
                    'upload_path' => $image_path,
                    'max_size' => 10000,
                    'encrypt_name' => TRUE
                );
                $this->load->library('upload', $config); 
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload()) {
                    if ($admin->num_rows() > 0) {
                        $a = $admin->row();
                        $file_name = './assets/admin/avatar/images/' . $a->gravatar;
                        if ($a->gravatar != null) {
                            delete_my_file($file_name);
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
                    delete_my_file($upload_info['full_path']);

                    $data_user = array(
                        'last_login' => time(),
                        'active' => $this->input->post('active'),
                        'group_id' => $this->input->post('group_id')
                    );
                    $data_profile = array(
                        'display_name' => $this->input->post('display_name'),
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'company' => $this->input->post('company'),
                        'gender' => $this->input->post('gender'),
                        'dob' => $dob_long,
                        'phone' => $this->input->post('phone'),
                        'mobile' => $this->input->post('mobile'),
                        'address' => $this->input->post('address'),
                        'gravatar' => $upload_info['file_name']
                    );
                    $this->Admin_m->edit_profile($user_id, $data_user, $data_profile);
                    $this->session->set_flashdata('error', lang('update') . lang('success'));
                    redirect('admin');
                } else {
                    $data_user = array(
                        'last_login' => time(),
                        'active' => $this->input->post('active'),
                        'group_id' => $this->input->post('group_id')
                    );
                    $data_profile = array(
                        'display_name' => $this->input->post('display_name'),
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'company' => $this->input->post('company'),
                        'gender' => $this->input->post('gender'),
                        'dob' => $dob_long,
                        'phone' => $this->input->post('phone'),
                        'mobile' => $this->input->post('mobile'),
                        'address' => $this->input->post('address')
                    );
                    $this->Admin_m->edit_profile($user_id, $data_user, $data_profile);
                    $this->session->set_flashdata('error', lang('edit_profile') . lang('success'));
                    redirect('admin');
                }
            } else {
                $this->display_admin('admin/edit_profile');
            }
        } else {
            $this->display_admin('admin/edit_profile');
        }
    }

    public function change_pass($user_id) {
        is_admin();
        $this->session->set_userdata('current_url', current_url());
        $config = array(
            array(
                'field' => 'apass',
                'label' => lang('old_pass'),
                'rules' => 'required|md5'
            ),
            array(
                'field' => 'npass',
                'label' => lang('new_pass'),
                'rules' => 'required|matches[confirm_npass]|md5'
            ),
            array(
                'field' => 'confirm_npass',
                'label' => lang('conf_pass'),
                'rules' => 'required|md5'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()) {
            $pass = $this->input->post('apass');
            $query = $this->Admin_m->is_password($pass, $user_id);
            if ($query) {
                $npass = $this->input->post('npass');
                $query1 = $this->Admin_m->change_pass($user_id, $npass);
                if ($query) {
                    $this->session->set_flashdata('error', lang('change_pass') . ' '.lang('success'));
                } else {
                    $this->session->set_flashdata('error', lang('change_pass') .' '. lang('fail'));
                }
                redirect('admin');
            } else {
                $this->_data['error'] = lang('in_pass');
                $this->display_admin('admin/admin/change_pass');
            }
        }else
            $this->display_admin('admin/admin/change_pass');
    }

    public function list_admin() {
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
        $config['base_url'] = base_url() . 'index.php/admin/list_admin' . '/' . $per_page . '/';
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->Admin_m->count_admin();
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['admin'] = $this->Admin_m->get_all_admin($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['total'] = $this->Admin_m->count_admin();
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_admin('admin/list_admin');
    }

    public function delete_admin($user_id, $perpage, $offset) {
        is_super_admin();
        /*if ($user_id == 1) {
            redirect('admin');
        }*/
        $admin = $this->Admin_m->get_admin_details($user_id);
        if ($admin->num_rows() > 0) {
            $a = $admin->row();
            $file_name = './assets/admin/avatar/images/' . $a->gravatar;
            if ($a->gravatar != null) {
                delete_my_file($file_name);
            }
        }
        $query = $this->Admin_m->delete_admin($user_id);
        if ($query)
            $this->session->set_flashdata('error', lang('delete') . lang('success'));
        else
            $this->session->set_flashdata('error', lang('delete') . lang('fail'));
        redirect('admin/list_admin/' . $perpage . '/' . $offset);
    }

    function delete_multi_admin($perpage, $offset) {
        is_super_admin();
        $list = "";
        $adelete = $this->input->post('delete');
        $N = count($adelete);
        for ($i = 0; $i < $N; $i++) {
            $admin = $this->Admin_m->get_admin_details($adelete[$i]);
            if ($admin->num_rows() > 0) {
                $a = $admin->row();
                $file_name = './assets/admin/avatar/images/' . $a->gravatar;
                if ($a->gravatar != null) {
                    delete_my_file($file_name);
                }
            }
            if ($adelete[$i] != "")
                $list = $list . ',' . $adelete[$i];
        }
        $list = '(' . substr($list, 1) . ')';

        $query = $this->Admin_m->delete_admins($list);
        if ($query)
            $this->session->set_flashdata('error', lang('delete') . lang('success'));
        else
            $this->session->set_flashdata('error', lang('delete') . lang('fail'));
        redirect('admin/list_admin/' . $perpage . '/' . $offset);
    }

    //add new admin
    function add_admin() {
        /* Captcha */
        //$this->load->view('accueil/register_success');
        is_admin();
        $this->session->set_userdata('current_url', current_url());
        $expiration_period = time() - 1800;
        $this->db->query("DELETE FROM captcha WHERE captcha_time < " . $expiration_period);
        $this->load->helper('captcha');
        $vals = array(
            'word' => strtoupper(random_string('alnum', 6)),
            'img_path' => './assets/captcha/',
            'img_url' => base_url() . 'assets/captcha/',
            'font_path' => base_url() . 'system/fonts/texb.ttf',
            'img_width' => '150',
            'img_height' => 32,
            'expiration' => 300
        );

        $cap = create_captcha($vals);

        $cap_save = array(
            'captcha_id' => '',
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $cap['word']
        );
        $query = $this->db->insert_string('captcha', $cap_save);
        $this->db->query($query);
        $this->_data['captcha_img'] = $cap['image'];
        /* End of captcha */

        if ($this->input->post('register')) {
            //Validation rules
            $validation = array(
                array(
                    'field' => 'first_name',
                    'label' => lang('first_name'),
                    'rules' => 'required'
                ),
                array(
                    'field' => 'last_name',
                    'label' => lang('last_name'),
                    'rules' => 'required'
                ),
                array(
                    'field' => 'password',
                    'label' => lang('password'),
                    'rules' => 'required|min_length[6]|max_length[20]'
                ),
                array(
                    'field' => 'confirm_password',
                    'label' => lang('confirm_pass'),
                    'rules' => 'required|matches[password]'
                ),
                array(
                    'field' => 'email',
                    'label' => lang('email'),
                    'rules' => 'required|valid_email|callback__email_check|xss_clean'
                ),
                array(
                    'field' => 'confirm_email',
                    'label' => lang('confirm_email'),
                    'rules' => 'required|valid_email|matches[email]|xss_clean'
                ),
                array(
                    'field' => 'display_name',
                    'label' => lang('display_name'),
                    'rules' => 'required|alphanumeric|maxlength[50]'
                )
                
            );

            // Set the validation rules
            $this->form_validation->set_rules($validation);

            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user_data_array = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'display_name' => $this->input->post('display_name'),
            );

            if ($this->form_validation->run()) {
                if ($this->Admin_m->add_admin($password, $email, $user_data_array)) {
                    $this->session->set_flashdata('error', lang('regiter_sucess'));
                    redirect('admin');
                }
                // Can't create the user, show why
                else {
                    $this->session->set_flashdata('error', lang('regiter_fail '));
                    redirect('admin/add_admin');
                }
            } else {
                $this->display_admin('admin/add_admin');
            }
        } else {
            $this->display_admin('admin/add_admin');
        }
    }

    function is_correct_captcha($captcha) {
        $expiration = time() - 1800;
        $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
        $binds = array($captcha, $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();

        if ($row->count == 0) {
            $this->form_validation->set_message('is_correct_captcha', 'Please enter correct word in the picture!');
            return FALSE;
        }
        return TRUE;
    }

    public function _email_check($email) {
        if ($this->Admin_m->email_check($email)) {
            $this->form_validation->set_message('_email_check', $this->lang->line('user_error_email'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

