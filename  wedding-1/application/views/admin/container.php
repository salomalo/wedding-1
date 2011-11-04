<?php
    $this->load->view($header['page']);
    $this->load->view('admin/sidebar/'.$sidebar);
    $this->load->view($load_path);
    $this->load->view($footer['page']);
?>
