<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');

class SearchBlogs extends MY_Controller
{
 
    function __construct() {
        parent::__construct();
 
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("incubator/SearchBlogs_Modal");
        $this->load->database();
    }
    
    public function index()
    {
        $select_category = $this->SearchBlogs_Modal->select_category();
        $data['select_category'] = $select_category;

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        $this->load->view('incubator/blogs/search_blogs',$data);
    }

}
