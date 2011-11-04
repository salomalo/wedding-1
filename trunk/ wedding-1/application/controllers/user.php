<?php
    class User extends FrontEnd_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('User_m');
        }
        function index(){
            $this->display_view('users/index');
        }
        function login(){
            if($this->input->post('submit')){

            } else{
                $this->display_view('users/login');
            }
        }
        /**
        * Method to register a new user
        * @access public
        * @return void
        */
        function register(){
            
            if($this->input->post('register')){
                //Validation rules  

                $validation = array(
                array(
                'field' => 'first_name',
                'label' => lang('user_first_name'),
                'rules' => 'required'
                ),
                array(
                'field' => 'last_name',
                'label' => lang('user_last_name'),
                'rules' => 'required'
                ),
                array(
                'field' => 'password',
                'label' => lang('user_password'),
                'rules' => 'required|min_length[6]|max_length[20]'
                ),
                array(
                'field' => 'confirm_password',
                'label' => lang('user_confirm_password'),
                'rules' => 'required|matches[password]'
                ),
                array(
                'field' => 'email',
                'label' => lang('user_email'),
                'rules' => 'required|valid_email|callback__email_check|xss_clean'
                ),
                array(
                'field' => 'confirm_email',
                'label' => lang('user_confirm_email'),
                'rules' => 'required|valid_email|matches[email]|xss_clean'
                ),
                array(
                'field' => 'username',
                'label' => lang('user_username'),
                'rules' => 'required|alphanumeric|maxlength[20]|callback__username_check'
                ),
                array(
                'field' => 'display_name',
                'label' => lang('user_display_name'),
                'rules' => 'required|alphanumeric|maxlength[50]'
                ),
                );

                // Set the validation rules
                $this->form_validation->set_rules($validation);

                $email                 = $this->input->post('email');
                $password             = $this->input->post('password');
                $username             = $this->input->post('username');
                $user_data_array     = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'display_name'  => $this->input->post('display_name'),
                );

                if ($this->form_validation->run())
                {
                    if ($this->User_m->register($username, $password, $email, $user_data_array))
                    {
                        $this->session->set_flashdata('regiter_sucess',lang('regiter_sucess'));
                        redirect('users/success');
                    }
                    // Can't create the user, show why
                    else
                    {
                        $this->_data['error_string'] = 'Failed to create user';
                    }
                }

                else
                {
                    $this->display_view('users/register');   
                }
            } else{
                $this->display_view('users/register');
            }
        }
        public function _email_check($email)
        {
            if ($this->User_m->email_check($email))
            {
                $this->form_validation->set_message('_email_check', $this->lang->line('user_error_email'));
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        public function _username_check($username)
        {
            if ($this->User_m->username_check($username))
            {
                $this->form_validation->set_message('_username_check', $this->lang->line('user_error_username'));
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }
?>
