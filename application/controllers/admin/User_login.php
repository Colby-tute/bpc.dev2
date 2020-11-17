<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_login extends CI_Controller
{


    function __construct()
    {
        //parent::__construct();
        echo "sdfhgfghfs";exit;
        /*$this->load->model("User_model");
        $this->load->database();*/
    }

    function index()
    {
       
        $this->load->view('users/login');
    }
     function login($m = NULL)
    {
       /* print_r($_POST);exit();*/
        if($_POST) {
            $results = $this->User_model->validate_user($_POST);
            $result = json_decode($results);
            //print_r($result);
            if(!empty($result)) {
                /*echo "if"; exit;*/
                $data = [
                    'id_user' => $result->id_user,
                    'user_id' => $result->user_id,
                    'username' => $result->username,
                    'user_type' => $result->user_type,
                    'user_image' => $result->user_image,
                    'parent_company_id'=> $result->parent_company_id,
                ];
                /*print_r($data);
                exit();*/
                $this->session->set_userdata($data);
                redirect('Home');
            } else {
               /*echo "else"; exit;*/
                 $this->session->set_flashdata('err_message', 'Username or password is wrong!');
                redirect('user');
            }
        }
    }

}
