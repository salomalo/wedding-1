<?php class Content_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
          $this->load->database();
    }

    function get_content($per_page, $off_set)
    {
         $this->db->select('content.*,page.page as page');
        $this->db->from('content');
        $this->db->join('page', 'content.idpage=page.id');
        $this->db->limit($per_page, $off_set);
        $this->db->order_by('page', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_detail_content($id)
    {
        $query=$this->db->get_where('content', array('id' => $id));
        return $query->row_array();
    }

    function update_content($data, $id){
         return $this->db->update('content',$data,array('id'=>$id));
    }
    function add_content($data){
          return $this->db->insert('content',$data);
      }
    function delete_content($id){
       return  $this->db->delete('content', array('id' => $id));
    }
    function delete_contents($list){
      $this->db->where('id in '.$list);
      $query=  $this->db->delete('content');
      return $query;
    }
         function get_page()
    {
        $query=$this->db->get('page');
        return $query->result_array();
    }
   function get_page_limit($per_page, $off_set)
    {
         $this->db->select();
        $this->db->from('page');
        $this->db->limit($per_page, $off_set);
        $this->db->order_by('page', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
    function add_page($data){
          return $this->db->insert('page',$data);
      }
       function update_page($data, $id){
         return $this->db->update('page',$data,array('id'=>$id));
    }
    function get_detail_page($id)
    {
        $query=$this->db->get_where('page', array('id' => $id));
        return $query->row_array();
    }

       function delete_page($id){
       return  $this->db->delete('page', array('id' => $id));
    }
    function delete_multi_page($list){
      $this->db->where('id in '.$list);
      $query=  $this->db->delete('page');
      return $query;
    }
}
?>