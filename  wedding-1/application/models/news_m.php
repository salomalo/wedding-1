<?php

class News_m extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function get_news($per_page, $off_set) {
        $this->db->select('news.*,cat_news.name, users.username');
        $this->db->from('news');
        $this->db->from('users');
        $this->db->join('cat_news', 'news.catid=cat_news.id', 'left');
        $this->db->where("users.id = news.user_post");
        $this->db->limit($per_page, $off_set);
        $this->db->order_by('news.id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_detail_news($id) {
        $this->db->select('news.*,cat_news.name');
        $this->db->from('news');
        $this->db->join('cat_news', 'news.catid=cat_news.id');
        $this->db->where(array('news.id' => $id));
        $query = $this->db->get();
        if($query->num_rows()<1){
            return FALSE;
        }else{
            return $query;
        }
        
     
    }

    function count_news() {
        $this->db->select('news.*,cat_news.name');
        $this->db->from('news');
        $this->db->join('cat_news', 'news.catid=cat_news.id');
        $this->db->order_by('news.id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

    function update_news($data, $id) {
        return $this->db->update('news', $data, array('id' => $id));
    }

    function add_news($data) {
        return $this->db->insert('news', $data);
    }

    function delete_news($id) {
        return $this->db->delete('news', array('id' => $id));
    }

    function delete_multi_news($list) {
        $this->db->where('id in ' . $list);
        $query = $this->db->delete('news');
        return $query;
    }

    function get_cat_limit($per_page, $off_set) {
        $this->db->select();
        $this->db->from('cat_news');
        $this->db->limit($per_page, $off_set);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows()>0){
        	 return $query->result_array();	
        }else{
        	return array();
        }
       
    }

    function add_cat($data) {
        return $this->db->insert('cat_news', $data);
    }

    function update_cat($data, $id) {
        return $this->db->update('cat_news', $data, array('id' => $id));
    }

    function get_detail_cat($id) {
        $query = $this->db->get_where('cat_news', array('id' => $id));
        $result = $query->row_array();
        if(count($result)<1){
            return FALSE;
        }else{
            return $result;
        }
    }

    function delete_cat($id) {
        $this->db->delete('news', array('catid' => $id));
        return $this->db->delete('cat_news', array('id' => $id));
    }

    function delete_multi_cat($list) {
        $this->db->where('id in ' . $list);
        $query = $this->db->delete('cat_news');
        return $query;
    }
    
    function get_news_home(){
        $this->db->select();
        $this->db->from('news');
        $this->db->limit(5);
        $this->db->where('available', 1);
        $this->db->order_by('posted', 'desc');
        $query = $this->db->get();
        $result = $query -> result_array();
        if(count($result)<1){
            return FALSE;
        }else{
            return $result;
        }
    }
    
    function get_available_news($per_page, $off_set){
        $this->db->select('news.*,cat_news.name');
        $this->db->from('news');
        $this->db->where('news.available', 1);
        $this->db->join('cat_news', 'news.catid=cat_news.id', 'left');
        $this->db->limit($per_page, $off_set);
        $this->db->order_by('news.id', 'DESC');
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    function get_available_news_by_category($id, $per_page = null, $off_set = null){
        $this->db->select('news.*,cat_news.name, cat_news.id AS cat_news_id');
        $this->db->from('news');
        $this->db->where('news.available', 1);
        $this->db->where('cat_news.id', $id);
        $this->db->join('cat_news', 'news.catid=cat_news.id', 'left');
        $this->db->limit($per_page, $off_set);
        $this->db->order_by('news.id', 'DESC');
        $query = $this->db->get();
        if($query->num_rows()<1){
            return FALSE;
        }
        return $query->result_array();   
    }
    
    function count_availble_news_by_category($id){
        $this->db->select('news.*,cat_news.name');
        $this->db->from('news');
        $this->db->where('news.available', 1);
        $this->db->where('cat_news.id', $id);
        $this->db->join('cat_news', 'news.catid=cat_news.id');
        $this->db->order_by('news.id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();    
    }
    
	function count_news_category(){
        $this->db->select('cat_news.*');
        $this->db->from('cat_news');
        $query = $this->db->get();
        return $query->num_rows();    
    }
    
    function count_avaiable_news(){
        $this->db->select('news.*,cat_news.name');
        $this->db->from('news');
        $this->db->where('news.available', 1);
        $this->db->join('cat_news', 'news.catid=cat_news.id');
        $this->db->order_by('news.id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    function get_news_content($id){
        $this->db->select();
        $this->db->from('news');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query -> num_rows()<1){
            return FALSE;
        }else{
            return $query;
        }
    }
    
    function get_categories_home(){
             
        $query =  "SELECT * FROM cat_news WHERE EXISTS
            (SELECT * FROM news WHERE news.catid = cat_news.id)";
            $result = $this->db->query($query);
            return $result->result_array();
    }
    
    function get_news_of_category_limit($id, $per_page, $off_set){
            $this->db->select('news.*,cat_news.name');
            $this->db->from('news');
            $this->db->where('news.available', 1);
            $this->db->join('cat_news', 'news.catid=cat_news.id', 'left');
            $this->db->where('cat_news.id', $id);
            $this->db->limit($per_page, $off_set);
            $this->db->order_by('news.id', 'DESC');
            $query = $this->db->get();

            return $query->result_array();
    }
    
    function count_news_by_category_id($id){
            $this->db->select('news.*,cat_news.name');
            $this->db->from('news');
            $this->db->where('news.available', 1);
            $this->db->join('cat_news', 'news.catid=cat_news.id');
            $this->db->where('cat_news.id', $id);
            $this->db->order_by('news.id', 'DESC');
            $query = $this->db->get();
            return $query->num_rows();
    }
    
    function get_current_cat_views($id){
        $query = $this->db->select("total_views")
                          ->from("cat_news")
                          ->where("id", $id)
                          ->get();
        return $query->row();
                
    }
    
    function update_cat_views($id, $data){
        $query = $this->db->update("cat_news", $data, array("id" => $id));
        return $query;
    }
    
    

}

?>
