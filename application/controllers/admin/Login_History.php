<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 

/**

 * @name Home.php

 * @author Imron Rosdiana

 */



date_default_timezone_set('Africa/Johannesburg');

class Login_History extends MY_Controller

{

 

    function __construct() {

        parent::__construct();

            if(empty($this->session->userdata('id_admin'))) {

            $this->session->set_flashdata('flash_data', 'You don\'t have access!');

            redirect('admin/masterlogin');

            

        }

        $this->load->model("admin/Login_History_model");

        $this->load->database();

    }



    public function index() {

        

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);



        $company = $this->Login_History_model->select_data_login_history($this->session->userdata('id_admin'),$this->session->userdata('admin_type')); 

        $data['login_history'] = $company;

        

        $this->load->view('admin/login_history',$data);

    }



    public function login_history(){



        $id = $this->input->post('user_id');

        $result = $this->Login_History_model->login_history($id);

        //print_r($result);exit;

        echo json_encode($result);

    }

 

    public function logout() {

        $data = ['id_user', 'username'];

        $this->session->unset_userdata($data);

 

        redirect('admin/masterlogin');

    }

}