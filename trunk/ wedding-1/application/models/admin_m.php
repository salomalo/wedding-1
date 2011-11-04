<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_m
 *
 * @author Gidaff_01
 */
class Admin_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function is_banned_admin($email) {
        if ($email == '') {
            return FALSE;
        }
        return $this->db->where(array('email' => $email, 'active' => 0))
                ->count_all_results('users') == 1;
    }

    //
    public function login($email, $password) {
        if (empty($email) || empty($password)) {
            return FALSE;
        }

        $this->db->select('email, id, password, group_id')
                ->where('email', $email);

        $query = $this->db->where('active', 1)
                        ->limit(1)
                        ->get('users');

        $result = $query->row();

        if ($query->num_rows() == 1) {
            if ($result->password === $password) {
                //update time last user login
                $this->update_last_login($result->id);

                $this->session->set_userdata('email', $result->email);
                $this->session->set_userdata('id', $result->id); //kept for backwards compatibility
                $this->session->set_userdata('user_id', $result->id); //everyone likes to overwrite id so we'll use user_id
                $this->session->set_userdata('group_id', $result->group_id);

                $group_row = $this->db->select('name')->where('id', $result->group_id)->get('users_groups')->row();

                $this->session->set_userdata('group', $group_row->name);

                return TRUE;
            }
        }

        return FALSE;
    }

    public function update_last_login($user_id) {
        return $this->db->update('users', array('last_login' => time()), array('id' => $user_id));
    }

    public function logout() {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('group_id');
    }

    public function edit_profile($user_id, $data_user, $data_profile) {
        $this->db->update('users', $data_user, array('id' => $user_id));
        return $this->db->update('users_profiles', $data_profile, array('user_id' => $user_id));
    }

    public function get_admin_details($user_id) {
        $query = $this->db->select('users_profiles.*,users.active,users.group_id')
                ->from('users, users_profiles')
                ->where('users_profiles.user_id', $user_id)
                ->where('users.id = users_profiles.user_id')
                ->get();
                
        if($query->num_rows() < 1){
            return FALSE;
        }
        return $query;
    }

    public function change_pass($user_id, $password) {
        return $this->db->update('users', array('password' => $password), array('id' => $user_id));
    }

    public function add_admin( $password, $email, $additional_data = false) {
        $group_name = 'admin';
        $group_id = $this->db->select('id')
                        ->where('name', $group_name)
                        ->get('users_groups')
                        ->row()->id;

        // IP Address
        $ip_address = $this->input->ip_address();
        $password = md5($password);

        // Users table.
        $data = array(
            'password' => $password,
            'email' => $email,
            'group_id' => $group_id,
            'ip_address' => $ip_address,
            'created_on' => now(),
            'last_login' => now(),
            'active' => 1
        );
        if ($this->db->insert('users', $data) > 0) {
            // Profile table.
            $id = $this->db->insert_id();
            $data = array('user_id' => $id);
            $columns = array('display_name', 'first_name', 'last_name', 'company', 'dob', 'gender', 'phone', 'mobile', 'address', 'gravatar');
            if (!empty($columns)) {
                foreach ($columns as $input) {
                    if (is_array($additional_data) && isset($additional_data[$input])) {
                        $data[$input] = $additional_data[$input];
                    } elseif ($this->input->post($input)) {
                        $data[$input] = $this->input->post($input);
                    }
                }
            }
        }
        return $this->db->insert('users_profiles', $data) > 0;
    }

    public function email_check($email = '') {
        if (empty($email)) {
            return FALSE;
        }
        return $this->db->where('email', $email)
                ->count_all_results('users') > 0;
    }

    public function is_password($old_pass, $user_id) {
        return $this->db->where(array('password' => $old_pass, 'id' => $user_id))
                ->count_all_results('users');
    }

    public function get_all_admin($per_page, $off_set) {
        $this->db->select('users_profiles.display_name, users.*');
        $this->db->from('users,users_profiles');
        $this->db->where('users.id = users_profiles.user_id');
        $this->db->where('users.group_id', 2);
        $this->db->limit($per_page, $off_set);
        return $this->db->get()->result_array();
    }

    public function count_admin() {
        $this->db->select('users_profiles.*');
        $this->db->from('users,users_profiles');
        $this->db->where('users.id = users_profiles.user_id');
        $this->db->where('users.group_id', 2);
        return count($this->db->get()->result_array());
    }

    public function delete_admin($user_id) {
        $this->db->delete('users', array('id' => $user_id));
        return $this->db->delete('users_profiles', array('user_id' => $user_id));
    }

    public function delete_admins($list) {
        $this->db->where('id in ' . $list);
        $query = $this->db->delete('users');
        $this->db->where('user_id in ' . $list);
        $query1 = $this->db->delete('users_profiles');
        return $query;
//        $this->db->delete('users', array('id' => $user_id));
//        return $this->db->delete('users_profiles', array('user_id' => $user_id));
    }

}

?>
