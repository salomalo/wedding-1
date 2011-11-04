<?php

class Admin_content extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Content_m');
        $this->_data['sidebar'] = "content";
    }

    function index() {
        is_admin();
        $this->list_content();
    }

    function list_content() {
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
        $config['base_url'] = base_url() . 'index.php/admin_content/list_content/' . $per_page . '/';
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->db->count_all('content');
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }
        $this->_data['page'] = $this->Content_m->get_page();
        $this->_data['query'] = $this->Content_m->get_content($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste de contenu";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_admin('admin/content/list_content');
    }

    function update_content($id, $perpage, $offset) {
        is_admin();
        $config = array(
            array(
                'field' => 'page',
                'label' => 'Page',
                'rules' => 'required'
            ),
            array(
                'field' => 'cle',
                'label' => 'Clé',
                'rules' => 'required'
            ),
            array(
                'field' => 'content',
                'label' => 'Contenu',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $data = array(
                    'idpage' => $this->input->post('page'),
                    'key' => $this->input->post('cle'),
                    'content' => $this->input->post('content')
                );
                $query = $this->Content_m->update_content($data, $id);
                if ($query)
                    $this->session->set_flashdata('error', "L'article a été modifié !");
                else
                    $this->session->set_flashdata('error', "L'article n'est pas modifié, veuillez reessayer !");
                redirect('admin_content/list_content/' . $perpage . '/' . $offset);
            }
        }

        $this->_data['query'] = $this->Content_m->get_detail_content($id);
        $this->_data['perpage'] = $perpage;
        $this->_data['offset'] = $offset;

        $this->display_admin('admin/content/update_content');
    }

    function add_content() {
        is_admin();
        $config = array(
            array(
                'field' => 'page',
                'label' => 'Page',
                'rules' => 'required'
            ),
            array(
                'field' => 'cle',
                'label' => 'Clé',
                'rules' => 'required'
            ),
            array(
                'field' => 'content',
                'label' => 'Contenu',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $data = array(
                    'idpage' => $this->input->post('page'),
                    'key' => $this->input->post('cle'),
                    'content' => $this->input->post('content')
                );
                $query = $this->Content_m->add_content($data);
                if ($query)
                    $this->session->set_flashdata('error', "L'article a été ajouté !");
                else
                    $this->session->set_flashdata('error', "L'article n'est pas ajouté, veuillez reessayer !");
                redirect('admin_content/list_content');
            }
        }
        $this->display_admin('admin/content/add_content');
    }

    function delete_content($id, $perpage, $offset) {
        is_admin();
        $query = $this->Content_m->delete_content($id);
        if ($query)
            $this->session->set_flashdata('error', "L'article a été supprimé !");
        else
            $this->session->set_flashdata('error', "L'article n'a pas été supprimé !");
        redirect('admin_content/list_content/' . $perpage . '/' . $offset);
    }

    function delete_contents($perpage, $offset) {
        is_admin();
        $list = "";
        $adelete = $this->input->post('delete');
        $N = count($adelete);
        for ($i = 0; $i < $N; $i++) {
            if ($adelete[$i] != ""
                )$list = $list . ',' . $adelete[$i];
        }
        $list = '(' . substr($list, 1) . ')';

        $query = $this->Content_m->delete_contents($list);
        if ($query)
            $this->session->set_flashdata('error', "L'article a été supprimé !");
        else
            $this->session->set_flashdata('error', "L'article n'a pas été supprimé !");
        redirect('admin_content/list_content/' . $perpage . '/' . $offset);
    }

    function list_page() {
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
        $config['base_url'] = base_url() . 'index.php/admin_content/list_page/' . $per_page . '/';
        $config['per_page'] = '10';
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->db->count_all('page');
        if ($off_set > 0 && $off_set == $config['total_rows']) {
            $off_set = $off_set - $per_page;
        }

        $this->_data['query'] = $this->Content_m->get_page_limit($config['per_page'], $off_set);
        $this->pagination->initialize($config);
        $this->_data['pagination'] = $this->pagination->create_links();
        $this->_data['page_title'] = "Liste de page";
        $this->_data['perpage'] = $per_page;
        $this->_data['offset'] = $off_set;
        $this->display_admin('admin/content/list_page');
    }

    function add_page() {
        is_admin();
        $config = array(
            array(
                'field' => 'page',
                'label' => 'Page',
                'rules' => 'required'
            ),
            array(
                'field' => 'meta_title',
                'label' => 'Meta title',
                'rules' => 'xss_clean'
            ),
            array(
                'field' => 'meta_description',
                'label' => 'Meta description',
                'rules' => 'xss_clean'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $data = array(
                    'page' => $this->input->post('page'),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description')
                );
                $query = $this->Content_m->add_page($data);
                if ($query)
                    $this->session->set_flashdata('error', "L'article a été ajouté !");
                else
                    $this->session->set_flashdata('error', "L'article n'est pas ajouté, veuillez reessayer !");
                redirect('admin_content/list_page');
            }
        }
        $this->display_admin('admin/content/add_page');
    }

    function update_page($id, $perpage, $offset) {
        is_admin();
        $config = array(
            array(
                'field' => 'page',
                'label' => 'Page',
                'rules' => 'required'
            ),
            array(
                'field' => 'meta_title',
                'label' => 'Meta title',
                'rules' => 'xss_clean'
            ),
            array(
                'field' => 'meta_description',
                'label' => 'Meta description',
                'rules' => 'xss_clean'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->input->post('submit')) {
            if ($this->form_validation->run()) {
                $data = array(
                    'page' => $this->input->post('page'),
                    'meta_title' => $this->input->post('meta_title'),
                    'meta_description' => $this->input->post('meta_description')
                );
                $query = $this->Content_m->update_page($data, $id);
                if ($query)
                    $this->session->set_flashdata('error', "L'article a été modifié!");
                else
                    $this->session->set_flashdata('error', "L'article n'est pas modifié, veuillez reessayer !");
                redirect('admin_content/list_page');
            }
        }
        $this->_data['query'] = $this->Content_m->get_detail_page($id);
        $this->_data['perpage'] = $perpage;
        $this->_data['offset'] = $offset;
        $this->display_admin('admin/content/update_page');
    }

    function delete_page($id, $perpage, $offset) {
        is_admin();
        $query = $this->Content_m->delete_page($id);
        if ($query)
            $this->session->set_flashdata('error', "L'article a été supprimé !");
        else
            $this->session->set_flashdata('error', "L'article n'a pas été supprimé !");
        redirect('admin_content/list_page/' . $perpage . '/' . $offset);
    }

    function delete_multi_page($perpage, $offset) {
        is_admin();
        $list = "";
        $adelete = $this->input->post('delete');
        $N = count($adelete);
        for ($i = 0; $i < $N; $i++) {
            if ($adelete[$i] != ""
                )$list = $list . ',' . $adelete[$i];
        }
        $list = '(' . substr($list, 1) . ')';

        $query = $this->Content_m->delete_multi_page($list);
        if ($query)
            $this->session->set_flashdata('error', "L'article a été supprimé !");
        else
            $this->session->set_flashdata('error', "L'article n'a pas été supprimé !");
        redirect('admin_content/list_page/' . $perpage . '/' . $offset);
    }

}

