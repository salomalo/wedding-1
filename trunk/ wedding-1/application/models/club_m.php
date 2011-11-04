<?php

class Club_m extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function add_club($data) {
        return $this->db->insert('club', $data);
    }

    function update_club($data, $id) {
        return $this->db->update('club', $data, array('id' => $id));
    }

    function get_all_club($per_page, $off_set) {
        return 
            $this->db->select('club.*, cat_club.id as cat_id, cat_club.title as cat_title')
                 ->from('club')
                 ->join('cat_club', 'club.cat_id = cat_club.id')
                 ->limit($per_page, $off_set)
                 ->order_by('club.id', 'desc')
                 ->get()->result_array();
                
       
    }
    
    function count_club(){
        return 
            $this->db->select('club.*, cat_club.id as cat_id, cat_club.title as cat_title')
                 ->from('club')
                 ->join('cat_club', 'club.cat_id = cat_club.id')
                 ->get()->num_rows();   
    }

    function get_club_by_kind($kind) {
        return $this->db->where('cat_id', $kind)
                ->get('club')->result_array();
    }

    function get_detail_club($id) {
        return $this->db->where('id', $id)
                ->get('club')->row_array();
    }

    function delete_club($id) {
        return $this->db->delete('club', array('id' => $id));
    }

    function delete_multi_club($list) {
        $this->db->where('id in ' . $list);
        $query = $this->db->delete('club');
        return $query;
    }

    function get_cat_limit($per_page, $off_set) {
        $this->db->select();
        $this->db->from('cat_club');
        $this->db->limit($per_page, $off_set);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function add_cat($data) {
        return $this->db->insert('cat_club', $data);
    }
    
    function update_cat($data, $id) {
        return $this->db->update('cat_club', $data, array('id' => $id));
    }

    function get_detail_cat($id) {
        $query = $this->db->get_where('cat_club', array('id' => $id));
        return $query->row_array();
    }
    
    function delete_cat($id) {
        $this->db->delete('club', array('cat_id' => $id));
        return $this->db->delete('cat_club', array('id' => $id));
    }

    function delete_multi_cat($list) {
        $this->db->where('id in ' . $list);
        $query = $this->db->delete('cat_club');
        return $query;
    }
    
    //-------------- Club Home functions----------------------//
    
    function get_club_categories(){
        return   $this->db->select('cat_club.*')
                 ->from('cat_club')
                 ->get()->result_array();
            
    }
    
    function get_all_clubs($per_page, $off_set){
        return
            $this->db->select('club.*, cat_club.id AS catid, cat_club.title as cattitle')
                     ->from('club')
                     ->join('cat_club','club.cat_id = cat_club.id')
                     ->limit($per_page, $off_set)
                     ->get()->result_array();
    }
    
    function get_club_content($id = 0){
        $query = 
            $this->db->select ('club.*')
                     ->from ('club')
                     ->where ('club.id', $id)
                     ->get();
        if($query->num_rows()< 1){
            return FALSE;
        }else{
            return $query -> row();
        }    
    }
    
    function get_club_by_category($id, $per_page, $off_set){
          $query =
            $this->db->select('club.*, cat_club.id AS catid, cat_club.title as cattitle')
                     ->from('club')
                     ->join('cat_club','club.cat_id = cat_club.id')
                     ->where('cat_club.id', $id)
                     ->limit($per_page, $off_set)
                     ->get()->result_array(); 
          if(count($query) < 1 ){
              return FALSE;
          }else{
              return $query;
          }   
    }
    
    function count_club_by_category($id){
          return
            $this->db->select('club.*, cat_club.id AS catid, cat_club.title as cattitle')
                     ->from('club')
                     ->join('cat_club','club.cat_id = cat_club.id')
                     ->where('cat_club.id', $id)
                     ->get()->num_rows();    
    }
   
}

?>
