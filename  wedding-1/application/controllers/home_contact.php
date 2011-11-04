<?php
  class Home_contact extends FrontEnd_Controller{
      public function __construct(){
          parent :: __construct();
          $this->load->model('Contact_m');
          $this->load->library('email');
      }
      
      function index(){
          $this->send_contact();
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
      
      function send_contact(){
      /* Captcha */
       
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
        
          $config = array(
                            array('field' => 'last_name',
                                  'label' => 'Nom',
                                  'rules' => 'required|trim|xss_clean'
                                 ),
                            
                            array('field' => 'first_name',
                                  'label' => 'Pre Nom',
                                  'rules' => 'required|trim|xss_clean'
                                 ),
                                 
                            array('field' => 'email',
                                  'label' => 'Email',
                                  'rules' => 'required|trim|xss_clean|valid_email'
                                 ),
                                 
                            array('field' => 'telephone',
                                  'label' => 'Telephone',
                                  'rules' => 'required|trim|xss_clean'
                                 ),
                                 
                            array('field' => 'content',
                                  'label' => 'Texte',
                                  'rules' => 'required|trim|xss_clean'
                                 ),
                             array(
                                    'field' => 'captcha',
                                    'Label' => 'Picture letters',
                                    'rules' => 'required|max_length[6]|callback_is_correct_captcha'     
                                    )
          
                         );
          $this->form_validation->set_rules($config);
          
          if($this->input->post('submit')){
              
              if($this->form_validation->run()){
                    
                    $receiver = $this->Contact_m->get_receiver_email();
                    $receiver_implode = implode(',' , $receiver);
                    $receiver_array = explode(',', $receiver_implode);
                   
                    foreach($receiver_array as $emails){
                        $destination = $emails['destination'];
                        $from = $this->input->post('email');
                        $subject = "Contact Email";
                        $message = $this->input->post('content');
                        $fullname = $this->input->post('first_name')." ".$this->input->post('last_name');
                    
                        $this->email->from($from, $fullname);     
                        $this->email->to($destination);
                        
                        $this->email->subject($subject);
                        $this->email->message($message);

                        $this->email->send();    
                    }
                                       
                    
                  
                    $firstname = $this->input->post('first_name');
                    $lastname = $this->input->post('last_name');
                    $email = $this->input->post('email');
                    $telephone = $this->input->post('telephone');
                    $content = $this->input->post('content');
                    $posttime = now();
                    
                    $data = array(
                                    'first_name' => $firstname,
                                    'last_name'  =>  $lastname,
                                    'email'      => $email,
                                    'telephone'  => $telephone,
                                    'content'    => $content,
                                    'posted_time' => $posttime
                                 );
                    $query = $this->Contact_m->add_contact($data);
                    
                    if($query > 0){
                        $this->session->set_flashdata('error', lang('add') . ' ' . lang('success'));    
                    }else{
                        $this->session->set_flashdata('error', lang('add') . ' ' . lang('fail'));    
                    }
                    redirect('home_contact/send_contact');    
                  
              }
              
          }
          
          
          
          $this->display_view('home/contact/add_contact.php');  
          
          if($this->input->post('reset')){
               redirect('home_contact/send_contact');
          }           
              
          
      }
  }
?>
