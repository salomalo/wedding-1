<?php class Contact_m extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
          $this->load->database();
    }
     function get_destination()
    {
        $query=$this->db->get_where('contact', array('id' => 1));
        return $query->row_array();
    }
     function update_destination($data){
         return $this->db->update('contact',$data,array('id'=>1));
    }
     function get_code()
    {
        $query=$this->db->get_where('contact', array('id' => 2));
        return $query->row_array();
    }
     function update_code($data){
         return $this->db->update('contact',$data,array('id'=>2));
    }
    
    function get_all_contact(){
        $query=$this->db->get_where('tbl_contact');
        return $query->result_array();    
    }
    
    function get_contact_pagination($per_page, $off_set)
    {
        $this->db->select('tbl_contact.*');
        $this->db->from('tbl_contact');
        $this->db->limit($per_page, $off_set);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_detail_contact($id)
    {
        $query=$this->db->get_where('tbl_contact', array('id' => $id));
        return $query->row_array();
    }
    
    function delete_contact($id){
       return  $this->db->delete('tbl_contact', array('id' => $id));
    }
    
    function delete_multi_contacts($list){
      $this->db->where('id in '.$list);
      $query=  $this->db->delete('tbl_contact');
      return $query;
    }
    
    function add_contact($data){
        return $this->db->insert('tbl_contact', $data);
    }
    
    function get_receiver_email(){
        $query = $this->db->select('destination')
                          ->from('contact')
                          ->where('id', 1)
                          ->get();
        
        if($query->num_rows() <= 0){
            return FALSE;
        }else{
            return $query->row_array();
        }
    }
}
?>
