<?php

defined('BASEPATH') OR exit('No direct script access allowed');

 

/**

 * @name Home.php

 * @author Imron Rosdiana

 */

date_default_timezone_set('Africa/Johannesburg');

class Faq extends MY_Controller

{

 

    function __construct() {

        parent::__construct();

 

        if(empty($this->session->userdata('id_admin'))) {

            $this->session->set_flashdata('flash_data', 'You don\'t have Of Pages');

            redirect('admin/masterlogin');

        }

        $this->load->model("admin/faq_model");

        $this->load->database();

    }

    

    public function index()

    {


        $result = $this->faq_model->select_all_faq_view($this->session->userdata('admin_uniqueid'));

        $data['tdata'] = $result;

        //print_r($result);

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $this->load->view('admin/faq/index',$data);

    }


    public function add() {

       

            if($_POST)

            {
                /*print_r($_POST);exit;*/

                $now = date("Y-m-d H:i:s");

                $data = array(

                         'tbl_faqs_admin_id' => $this->session->userdata('admin_uniqueid'),


                         'tbl_faqs_role_type' => $this->input->post('tbl_faqs_role_type'),


                         'tbl_faqs_title' => $this->input->post('tbl_faqs_title'),


                         'tbl_faqs_desc'=> $this->input->post('tbl_faqs_desc'),


                         'tbl_faqs_insertdate' => $now,

                ); 

                $result = $this->faq_model->insert_master($data);

                if($result == 1) 
                {

                    $this->session->set_flashdata('success', 'Data Inserted Successfully!');

                    redirect('admin/faq');

                }

                elseif($result == 0) 
                {

                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');

                    redirect('admin/faq');

                }

            }

            $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

            $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

            

            $role = $this->faq_model->select_all_role();

            $data['role'] = $role;


            $this->load->view('admin/faq/add',$data);



    }


    public function edit($i) {

        //print_r($i);

        $editdt = $this->faq_model->select_faq_data($i);


        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $data['userdt'] = $editdt;

        $role = $this->faq_model->select_all_role();

        $data['role'] = $role;


        $this->load->view('admin/faq/edit',$data);



    }



    public function update($upd_id) {

        //echo $upd_id;exit;

        //print_r($_POST);exit();

            if($_POST)

            {

                $now = date("Y-m-d H:i:s");

                $data = array(

                         'tbl_faqs_role_type' => $this->input->post('tbl_faqs_role_type'),

                         'tbl_faqs_title' => $this->input->post('tbl_faqs_title'),


                         'tbl_faqs_desc'=> $this->input->post('tbl_faqs_desc'),

                ); 

                $result = $this->faq_model->update_master($data,$upd_id);

                if($result == 1) {

                        $this->session->set_flashdata('success', 'Data Inserted Successfully!');

                        redirect('admin/faq');

                    }

                else if($result == 0) {

                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');

                    redirect('admin/faq');

                }

            }

            $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

            $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

            

            //$this->load->view ('home', $data);

            $this->load->view('admin/faq/index',$data);

            //print_r($_POST);exit;



    }



    public function delete($i) {

        //print_r($i);exit;

         

            $result = $this->faq_model->did_delete_company_row($i);

            if($result == 1) {

                $this->session->set_flashdata('success', 'Data Delete Successfully!');

                redirect('admin/faq');

            }

            elseif($result == 0) {

                $this->session->set_flashdata('danger', 'We are in truble Data Could not Delete!');

                redirect('admin/faq');

            }

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        

        //$this->load->view ('home', $data);

        $this->load->view('admin/faq/index',$data);



    }


}