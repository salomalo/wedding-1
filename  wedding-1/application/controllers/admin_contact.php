<?php
    class Admin_contact extends Admin_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Contact_m');
            $this->_data['sidebar']="contact";
        }
       function index(){
           $this->list_customer_contact();
        }
       function list_destination(){
        $config = array(
            array(
                'field' => 'destination',
                'label' => 'Destination',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
         if ($this->input->post('submit')) {
              if ($this->form_validation->run()) {
              $data = array(
                        'destination' => $this->input->post('destination')
                    );
               $query=$this->Contact_m->update_destination($data);
           if($query) $this->session->set_flashdata('error', "L'article a été modifié !");
            else  $this->session->set_flashdata('error', "L'article n'est pas modifié, veuillez reessayer !");
           redirect('admin_contact/list_destination');

              } }
               $this->_data['query']  = $this->Contact_m->get_destination();
               $this->display_admin('admin/contact/contact');
         }
       function analitics(){
        $config = array(
            array(
                'field' => 'code',
                'label' => 'Code',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
         if ($this->input->post('submit')) {
              if ($this->form_validation->run()) {
              $data = array(
                        'destination' => $this->input->post('code')
                    );
               $query=$this->Contact_m->update_code($data);
           if($query) $this->session->set_flashdata('error', "L'article a été modifié !");
            else  $this->session->set_flashdata('error', "L'article n'est pas modifié, veuillez reessayer !");
           redirect('admin_contact/analitics');

              } }
               $this->_data['query']  = $this->Contact_m->get_code();
               $this->display_admin('admin/contact/analitics');
         }
         
         function list_customer_contact(){
            is_admin();
            $per_page = $this->uri->segment(3);
            if ($per_page == "") {
                $per_page = 10;
            }
            $off_set = $this->uri->segment(4);
            if ($off_set == "") {
                $off_set = 0;
            }
            $config['full_tag_open'] = "<div id='wrapperpage'>";
            $config['full_tag_close'] = '</div>';
            $config['cur_tag_open'] = '<span id="pageactive"> ';
            $config['cur_tag_close'] = ' </span>';
            $config['next_link'] = 'Suiv.';
            $config['prev_link'] = 'Prec.';
            $config['base_url'] = base_url() . 'index.php/admin_contact/list_customer_contact/' . $per_page . '/';
            $config['per_page'] = '10';
            $config['uri_segment'] = 4;
            $config['total_rows'] = $this->db->count_all('tbl_contact');
            if ($off_set > 0 && $off_set == $config['total_rows']) {
                $off_set = $off_set - $per_page;
            }
            $this->_data['query'] = $this->Contact_m->get_contact_pagination($config['per_page'], $off_set);
            $this->pagination->initialize($config);
            $this->_data['pagination'] = $this->pagination->create_links();
            $this->_data['page_title'] = "Liste de contact";
            $this->_data['perpage'] = $per_page;
            $this->_data['offset'] = $off_set;
            $this->display_admin('admin/contact/list_contact');
            }
            
    function contact_content($id, $perpage, $offset) {
        is_admin();
       
        $this->_data['query'] = $this->Contact_m->get_detail_contact($id);
        $this->_data['perpage'] = $perpage;
        $this->_data['offset'] = $offset;
        $this->display_admin('admin/contact/contact_content');
    }
    
    function delete_contact($id, $perpage, $offset) {
        is_admin();
        $query = $this->Contact_m->delete_contact($id);
        if ($query)
            $this->session->set_flashdata('error', "Contact a été supprimé !");
        else
            $this->session->set_flashdata('error', "Contact n'a pas été supprimé !");
        redirect('admin_contact/list_customer_contact/' . $perpage . '/' . $offset);
    }
    
    function delete_multi_contacts($perpage, $offset) {
        is_admin();
        $list = "";
        $adelete = $this->input->post('delete');
        $N = count($adelete);
        for ($i = 0; $i < $N; $i++) {
            if ($adelete[$i] != ""
                )$list = $list . ',' . $adelete[$i];
        }
        $list = '(' . substr($list, 1) . ')';

        $query = $this->Contact_m->delete_multi_contacts($list);
        if ($query)
            $this->session->set_flashdata('error', "Contact a Ã©tÃ© supprimÃ© !");
        else
            $this->session->set_flashdata('error', "Contact n'a pas Ã©tÃ© supprimÃ© !");
        redirect('admin_contact/list_customer_contact/' . $perpage . '/' . $offset);
    }
}
?>
