<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**

 * @name Home.php

 * @author Imron Rosdiana

 */

date_default_timezone_set('Africa/Johannesburg');

class AdminMaster extends MY_Controller

{

 

    function __construct() {

        parent::__construct();

            if(empty($this->session->userdata('id_admin'))) {

            $this->session->set_flashdata('flash_data', 'You don\'t have Of Pages');

            redirect('admin/masterlogin');

           }

         

        $this->load->model("admin/Admin_master_model");

        $this->load->database();

    }









    public function index() {

        //$dte['he'] = "hello";

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        

        //$this->load->view ('home', $data);

        

        

        $result = $this->Admin_master_model->select_all_data();

        $data['tdata'] = $result;

        $this->load->view('admin/admin_master/index',$data);

    }



    public function add() {

        

        $password = $this->input->post('password');

        $confirm_password = $this->input->post('confirm_password');

        if ($password == $confirm_password) 

        {

            if($_POST)

            {//print_r($_POST);exit();

                $now = date("Y-m-d H:i:s");

                $randomid = mt_rand(100000,999999); 

                $data = array(

                        'tbl_admins_uniqueid' => $randomid,

                        'tbl_admins_roleid' => $this->session->userdata('admin_type'),



                        'tbl_admins_firstname' => $this->input->post('firstname'),



                        'tbl_admins_lastname' => $this->input->post('lastname'),



                        'tbl_admins_email' => $this->input->post('email'),



                        'tbl_admins_mobile' =>  $this->input->post('phone'),



                        'tbl_admins_password' => md5($this->input->post('password')),



                        'tbl_admins_countrycode' => $this->input->post('country_code'),



                        'tbl_admins_insertdate' => $now,



                    ); 

                $result = $this->Admin_master_model->insert_master($data);

                if($result == 2) {

                    $this->session->set_flashdata('danger', 'Unique Id, Username, Email id is Duplicate!');

                    redirect('admin/adminmaster');

                } else if($result == 1) {

                    $this->session->set_flashdata('success', 'Data Inserted Successfully!');

                    redirect('admin/adminmaster');

                }

                elseif($result == 0) {

                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');

                    redirect('admin/adminmaster');

                }

            }

            $role = $this->Admin_master_model->select_all_role();

            $data['role'] = $role;

            $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

            $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

            

            //$this->load->view ('home', $data);

            $this->load->view('admin/admin_master/add_master',$data);

        }

        else {

            $this->session->set_flashdata('danger', 'Password and Confirm Password does not match');

            redirect('admin/adminmaster/AdminMaster/add');

        }

       

    }







    public function edit($i) {

        //print_r($i);

        $editdt = $this->Admin_master_model->select_data($i);

        $role = $this->Admin_master_model->select_all_role();

        $data['role'] = $role;

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $data['userdt'] = $editdt;

        

        //$this->load->view ('home', $data);

        $this->load->view('admin/admin_master/edit_master',$data);



    }



    public function update($i) {



        //print_r($_POST);exit;

       

         if($_POST)

            {

                $now = date("Y-m-d H:i:s");



                

                $data = array(



                        'tbl_admins_roleid' => $this->session->userdata('admin_type'),



                        'tbl_admins_firstname' => $this->input->post('firstname'),



                        'tbl_admins_lastname' => $this->input->post('lastname'),



                        'tbl_admins_email' => $this->input->post('email'),



                        'tbl_admins_mobile' =>  $this->input->post('phone'),



                        'tbl_admins_countrycode' => $this->input->post('country_code'),



                    ); 

                $result = $this->Admin_master_model->update_master($data,$i);

                if($result == 2) {

                    $this->session->set_flashdata('danger', 'Username or Email id is Duplicate!');

                    redirect('admin/adminmaster');

                } else if($result == 1) {

                    $this->session->set_flashdata('success', 'Data Updated Successfully!');

                    redirect('admin/adminmaster');

                }

                elseif($result == 0) {

                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Update!');

                    redirect('admin/adminmaster');

                }

            }

            



    }



    public function delete($i) {

        //print_r($i);exit;

            $result = $this->Admin_master_model->did_delete_row($i);

            if($result == 1) {

                $this->session->set_flashdata('success', 'Data Delete Successfully!');

                redirect('admin/adminmaster');

            }

            elseif($result == 0) {

                $this->session->set_flashdata('danger', 'We are in truble Data Could not Delete!');

                redirect('admin/adminmaster');

            }

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        

        //$this->load->view ('home', $data);

        $this->load->view('admin/admin_master/index',$data);



    }

 

}