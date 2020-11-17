<?php defined('BASEPATH') or exit('No direct script access allowed');

class PageNotFound extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $user = $this->session->userdata('id_user');
        if($user){
            $type = $this->session->userdata('user_type');
            if($type == 2){
                $this->load->view('includes/header');
                $this->load->view('page_not_found');
                $this->load->view('includes/footer');
            }else if($type == 3){
                $this->load->view('incubator/includes/header');
                $this->load->view('page_not_found');
                $this->load->view('incubator/includes/footer');
            }else if($type == 4){
                $this->load->view('bdsp/includes/header');
                $this->load->view('page_not_found');
                $this->load->view('bdsp/includes/footer');
            }
        }else if($this->session->userdata('id_admin')){
            $this->load->view('admin/includes/header');
            $this->load->view('page_not_found');
            $this->load->view('admin/includes/footer');            
        }else{
            redirect('Login');
        }
    }
}