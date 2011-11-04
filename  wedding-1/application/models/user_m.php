<?php
    class User_m extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }
        public function register($username, $password, $email, $additional_data = false)
        {
            $group_name = 'user';
            $group_id = $this->db->select('id')
            ->where('name', $group_name)
            ->get('users_groups')
            ->row()->id;

            // IP Address
            $ip_address = $this->input->ip_address();
            $password = md5($password);

            // Users table.
            $data = array(
            'username'   => $username,
            'password'   => $password,
            'email'      => $email,
            'group_id'   => $group_id,
            'ip_address' => $ip_address,
            'created_on' => now(),
            'last_login' => now(),
            'active'     => 1
            );
            if($this->db->insert('users',$data)>0){
                // Profile table.
                $id = $this->db->insert_id();
                $data = array('user_id' => $id);
                $columns = array('display_name','first_name','last_name','company','dob','gender','phone','mobile','address','gravatar');
                if (!empty($columns))
                {
                    foreach ($columns as $input)
                    {
                        if (is_array($additional_data) && isset($additional_data[$input]))
                        {
                            $data[$input] = $additional_data[$input];
                        }
                        elseif ($this->input->post($input))
                        {
                            $data[$input] = $this->input->post($input);
                        }
                    }
                }                    
            }
            return $this->db->insert('users_profiles', $data)>0;
        }
        public function email_check($email = '')
        {
            if (empty($email))
            {
                return FALSE;
            }
            return $this->db->where('email', $email)
            ->count_all_results('users') > 0;
        }
        public function username_check($username = '')
        {
            if (empty($username))
            {
                return FALSE;
            }
            return $this->db->where('username', $username)
            ->count_all_results('users') > 0;
        }
    }
?>
