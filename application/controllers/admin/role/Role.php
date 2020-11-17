<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**

 * @name Home.php

 * @author Imron Rosdiana

 */

date_default_timezone_set('Africa/Johannesburg');

class Role extends MY_Controller

{

 

    function __construct() {

        parent::__construct();

            if(empty($this->session->userdata('id_admin'))) {

            $this->session->set_flashdata('flash_data', 'You don\'t have Of Pages');

            redirect('admin/masterlogin');

        }

        $this->load->model("admin/Role_model");

        $this->load->database();

    }







    public function index() {

        //$dte['he'] = "hello";

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        

        //$this->load->view ('home', $data);

        $result = $this->Role_model->select_all_data();

        $data['tdata'] = $result;

        $this->load->view('admin/role/index',$data);

    }



    public function add() {

        

            if($_POST)

            {

                //print_r($_POST);exit();

                $now = date("Y-m-d H:i:s");

                $data = array(



                        'tbl_roles_title' => $this->input->post('name'),



                        'tbl_roles_insertdate' => $now,



                    ); 

                $result = $this->Role_model->insert_master($data);

               if($result == 1) {

                    $this->session->set_flashdata('success', 'Data Inserted Successfully!');

                    redirect('admin/role');

                }

                elseif($result == 0) {

                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');

                    redirect('admin/role');

                }

            }

            $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

            $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

            

            //$this->load->view ('home', $data);

            $this->load->view('admin/role/add_master',$data);

       

    }







    public function edit($i) {

        //print_r($i);

        $editdt = $this->Role_model->select_data($i);

        

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $data['userdt'] = $editdt;

        

        //$this->load->view ('home', $data);

        $this->load->view('admin/role/edit_master',$data);



    }







     public function update($i) {

       

            if($_POST)

            {

                $now = date("Y-m-d H:i:s");

                //print_r($password);exit;

                $data = array(



                        'tbl_roles_title' => $this->input->post('name'),



                        'tbl_roles_id' => $i,



                    ); 

                $result = $this->Role_model->update_master($data);

                if($result == 0) {

                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Updated!');

                    redirect('admin/role');

                } else {

                    $this->session->set_flashdata('success', 'Data updated Successfully!');

                    redirect('admin/role');

                }

            }

            $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

            $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

            

            //$this->load->view ('home', $data);

            $this->load->view('admin/role',$data);

        //print_r($_POST);exit;



    }



    public function delete($i) {

        //print_r($i);exit;

            

            $result = $this->Role_model->did_delete_row($i);

            if($result == 1) {

                $this->session->set_flashdata('success', 'Data Delete Successfully!');

                redirect('admin/role');

            }

            elseif($result == 0) {

                $this->session->set_flashdata('danger', 'We are in truble Data Could not Delete!');

                redirect('admin/role');

            }

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        

        //$this->load->view ('home', $data);

        $this->load->view('admin/role/index',$data);



    }

 

}