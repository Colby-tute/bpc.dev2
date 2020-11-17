<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');

class Blogs extends MY_Controller
{
 
    function __construct() {
        parent::__construct();
 
        if(empty($this->session->userdata('id_admin'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("admin/Blogs_Modal");
        $this->load->database();
    }
    
    public function index($catid = NULL,$subcatid = NULL)
    {
        /*echo $catid;
        echo $subcatid;exit;*/
        $result = $this->Blogs_Modal->select_blogs($catid,$subcatid);
        $data['blogs'] = $result;

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $this->load->view('admin/blogs/index',$data);
    }

    public function view($id) {

        $result = $this->Blogs_Modal->select_blog_id($id);
        $data['blog'] = $result;

        $random_blogs = $this->Blogs_Modal->random_blogs($id);
        $data['random_blogs'] = $random_blogs;

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $this->load->view('admin/blogs/view',$data);
    }
}
