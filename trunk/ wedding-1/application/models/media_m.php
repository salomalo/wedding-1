<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of media_m
 *
 * @author Gidaff_01
 */
class Media_m extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_all_medias($kind, $per_page, $off_set) {
        return $this->db->select('media.*, albums.title as album')
                ->from('media')
                ->where('media.kind', $kind)
                ->join('albums', 'media.album_id = albums.id', 'left')
                ->order_by('media.id DESC')
                ->limit($per_page, $off_set)
                ->get()->result_array();
    }

    function count_media($kind) {
        return count($this->db->select('media.*, albums.title as album')
                        ->from('media')
                        ->where('media.kind', $kind)
                        ->join('albums', 'media.album_id = albums.id', 'left')
                        ->order_by('media.id DESC')
                        ->get()->result_array());
    }

    function get_all_medias_by_album($album_id, $kind, $per_page, $off_set) {
        return $this->db->select('media.*, albums.title as album')
                ->from('media')
                ->where('media.kind', $kind)
                ->where('media.album_id', $album_id)
                ->join('albums', 'media.album_id = albums.id', 'left')
                ->order_by('media.id DESC')
                ->limit($per_page, $off_set)
                ->get()->result_array();
    }

    function count_media_by_album($album_id) {
        return count($this->db->select('media.*, albums.title as album')
                        ->from('media')
                        ->where('media.album_id', $album_id)
                        ->join('albums', 'media.album_id = albums.id', 'left')
                        ->order_by('media.id DESC')
                        ->get()->result_array());
    }

    function add_media($additional_data, $kind, $available = null) {
        $data = array('upload_time' => now(), 'kind' => $kind, 'available' =>$available);
        $columns = array('title','description','file_path', 'upload_time', 'album_id', 'kind');

        if (!empty($columns)) {
            foreach ($columns as $input) {
                if (is_array($additional_data) && isset($additional_data[$input])) {
                    $data[$input] = $additional_data[$input];
                } elseif ($this->input->post($input)) {
                    $data[$input] = $this->input->post($input);
                }
            }
        }
        return $this->db->insert('media', $data);
    }

    function delete_media($id) {
        return $this->db->delete('media', array('id' => $id));
    }

    function delete_medias($list) {
        $this->db->where('id in ' . $list);
        $query = $this->db->delete('media');
        return $query;
    }

    function get_detail_media($id) {
        return $this->db->select('media.*, albums.title as album')
                ->from('media')
                ->where('media.id', $id)
                ->join('albums', 'media.album_id = albums.id', 'left')
                ->order_by('media.id DESC')
                ->get()->row_array();
    }

    function get_media_by_album($album_id) {
        return $this->db->select('media.*, albums.title as album')
                ->from('media')
                ->where('media.album_id', $album_id)
                ->join('albums', 'media.album_id = albums.id', 'left')
                ->order_by('media.id DESC')
                ->get()->result_array();
    }

    function update_media($id, $data) {
              
        return $this->db->update('media', $data, array('id' => $id));
    }

    function get_all_albums($per_page, $off_set) {
        return $this->db->select()
                ->from('albums')
                ->limit($per_page, $off_set)
                ->get()->result_array();
    }
    function get_all_albums_sidebar() {
        return $this->db->select()
                ->from('albums')
                ->get()->result_array();
    }

    function count_album() {
        return count($this->db->select()
                        ->from('albums')
                        ->get()->result_array());
    }

    function add_album($data) {
        return $this->db->insert('albums', $data);
    }

    function update_album($data, $id) {
        return $this->db->update('albums', $data, array('id' => $id));
    }

    function delete_album($id) {
        $this->db->delete('media', array('album_id' => $id));
        return $this->db->delete('albums', array('id' => $id));
    }
    function delete_albums($list) {
        $this->db->where('id in ' . $list);
        $query = $this->db->delete('albums');
        $this->db->where('album_id in ' . $list);
        $query1 = $this->db->delete('media');
        return $query;
    }

    function get_album_by_id($id) {
        return $this->db->select()
                ->from('albums')->where('id', $id)
                ->get();
    }
    function get_album_name($id) {
        return $this->db->select('title')
                ->from('albums')->where('id', $id)
                ->get()->row_array();
    }
    
    function get_image_title($title, $id){
        $query = "SELECT title FROM media WHERE id != '".$id."' AND title = '".$title."'";
        $result = $this->db->query($query);
        return $result;
    }
    
    function get_feature_video_link(){
        $this->db->select();
        $this->db->from('media');
        $this->db->where('kind', 'video');
        $this->db->where('available', 1);
        $this->db->limit(8);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query -> result_array();
      
        
    }
    
    function get_lastest_feature_video_link(){
        return $this->db->select()->from('media')->where(array('media.kind'=>'video'))
        ->order_by('media.id','DESC')->limit(1)->get()->row();
    }
    
    
    function get_photo_albums($per_page, $off_set){
       $query =  "SELECT * FROM albums WHERE EXISTS(SELECT * FROM media WHERE media.album_id = albums.id) AND albums.kind = \"image\" LIMIT ".$off_set.", ".$per_page." ";
       $result = $this->db->query($query);
            /*$this->db->select('albums.*, media.id, media.album_id as albumid')
                     ->from('albums')
                     ->join('media', 'media.album_id = albums.id')  
                     ->where('albums.kind', 'image')
                                                               
                     ->limit($per_page, $off_set)
                     ->get()->result_array();   */
          if(count($result) < 1 ){
              return FALSE;
          }else{
              return $result->result_array();
          }       
    }
    
    
    
       
    function count_photo_albums(){
            $query =  "SELECT * FROM albums WHERE EXISTS(SELECT * FROM media WHERE media.album_id = albums.id) AND albums.kind = \"image\" ";
            $result = $this->db->query($query);
            return $result->num_rows();
    }
                             
    function list_photo_by_album($id){
        $query =
            $this->db->select('media.*, albums.id')
                     ->from('media')
                     ->join('albums','albums.id = media.album_id')
                     ->where('albums.id', $id)
                     
                     ->get()->result_array(); 
          if(count($query) < 1 ){
              return FALSE;
          }else{
              return $query;
          }   
    }
    
    function list_other_photo_album($old_album_id, $per_page, $off_set){
        
            $query =  "SELECT * FROM albums WHERE EXISTS
            (SELECT * FROM media WHERE media.album_id = albums.id)
             AND albums.kind = 'image' AND albums.id <> $old_album_id
             LIMIT ".$off_set.", ".$per_page."";
            $result = $this->db->query($query);
            return $result->result_array();
    }
    
    function count_other_photo_album($old_album_id){
        $query =
            $this->db->select('albums.*')
                     ->from('albums')
                     ->where('albums.kind', 'image')
                     ->where_not_in('albums.id', array($old_album_id))
                     ->get()->num_rows();
        return $query; 
         
    }
    
    function defaul_photo_of_album($id){
        $query =
            $this->db->select('media.*, albums.id as albumid, albums.kind')
                     ->from('media')
                     ->join('albums','albums.id = media.album_id')
                     ->where('albums.id', $id)
                     ->where('albums.kind', 'image')
                     ->order_by('media.id', 'ASC')
                     ->limit(1)
                     ->get()->row(); 
          if(count($query) < 1 ){
              return FALSE;
          }else{
              return $query;
          }   
    }
    
    function count_photo_in_album($id){
        $query =
            $this->db->select('media.*, albums.id')
                     ->from('media')
                     ->join('albums','albums.id = media.album_id')
                     ->where('albums.id', $id)
                     ->where('media.kind', 'image')
                     ->get()->num_rows(); 
         
    }
    
    function list_video_albums($per_page, $off_set){
          $query=  
            $this->db->select('albums.*')
                ->from('albums')
                ->where('albums.kind', 'video')
                ->limit($per_page, $off_set)
                ->get()->result_array(); 
          
          return $query;
    }
    
    function count_video_albums(){
        $query = 
             $this->db->select('albums.*')
                     ->from('albums')
                     ->where('albums.kind', 'video')
                     ->get();
        return $query->num_rows();
                
    }
    
    
    function album_video($id, $per_page, $off_set){
        $query =
            $this->db->select('media.*, albums.id as albumid, albums.kind')
                     ->from('media')
                     ->join('albums', 'albums.id = media.album_id')
                     ->where('albums.id', $id)
                     ->where('albums.kind', 'video')
                     ->limit($per_page, $off_set)
                     ->get()->result_array();
        
        if(count($query)<1){
            return FALSE;
        }
        return $query;
        
    }
             
    function count_video_in_album($current_video_id){
       $query =
            $this->db->select('media.*, albums.id as albumid')
                     ->from('media')
                     ->join('albums', 'albums.id = media.album_id')
                     ->where('albums.kind', 'video')
                     ->where_not_in('media.id', array($current_video_id))
                     ->get()->num_rows();
       return $query;
        
                       
    }
    
    function get_newest_video_in_album($album_id){
        $query = 
            $this->db->select('media.*, albums.id as albumid')
                     ->from('media')
                     ->join('albums', 'albums.id = media.album_id')
                     ->where('albums.kind', 'video')
                     ->where('albums.id', $album_id)
                     ->order_by('media.id', 'DESC')
                     ->limit(1)
                     ->get()->row();
        return $query;
    }
    
    function get_other_video_in_album($album_id, $current_video_id, $per_page, $off_set){
        $query =
            $this->db->select('media.*, albums.id as albumid, albums.kind')
                     ->from('media')
                     ->join('albums', 'albums.id = media.album_id')
                     ->where('albums.id', $album_id)
                     ->where('albums.kind', 'video')
                     ->where_not_in('media.id', array($current_video_id))
                     ->limit($per_page, $off_set)
                     ->get()->result_array();
        
        if(count($query)<0){
            return FALSE;
        }
        return $query;
            
    }
    
    function play_video($video_id, $album_id, $per_page, $offset){
        $query =
            $this->db->select('media.*, albums.id as albumid, albums.kind')
                     ->from('media')
                     ->join('albums', 'albums.id = media.album_id')
                     ->where('media.id', $video_id)
                     ->where('albums.id', $id)
                     ->where('albums.kind', 'video')
                     ->limit($per_page, $off_set)
                     ->get()->result_array();
        
        if(count($query)<1){
            return FALSE;
        }
        return $query;
      
    }
    
    function get_current_video_link($video_id){
        $this->db->select('media.*');
        $this->db->from('media');
        $this->db->where('id', $video_id);
        return $this->db->get()->row();
    }
    
    function get_video_play_home($id){
        $query =
                $this->db->select()
                         ->from('media')
                         ->where('media.kind', 'video')
                         ->where('media.id', $id)
                         ->where('media.available', 1)
                         ->limit(1)
                         ->get()->row();
        
                        
            return $query;
       
        
    }
    
    function get_other_video_home($current_video_id){
        $query = $this->db->select()
                 ->from('media')
                 ->where('media.kind', 'video')
                 ->where('media.available', 1) 
                 ->where('media.id <>', $current_video_id)
                 ->limit(8)
                 ->get()->result_array();
            if(count($query) > 0){
            	return $query;	
            }else{
            	return false;
            }       
            
             
                        
    }
    
    

}

?>
