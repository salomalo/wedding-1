<?php
class Contact extends FrontEnd_Controller{
    function __construct(){
        parent::__construct();    
    }
    function index(){
        $this->add();
    }
    function add(){
        if($this->input->post('submit')){
            
        } else{
            $this->display_view('contact/form');
        }
    }                 
}
?>
