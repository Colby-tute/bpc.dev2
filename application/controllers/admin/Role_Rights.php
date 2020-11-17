<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Role_Rights extends CI_Controller

{



    function __construct()

    {

        parent::__construct();

         if(empty($this->session->userdata('id_admin'))) {

            $this->session->set_flashdata('flash_data', 'You don\'t have Of Pages');

            redirect('admin/masterlogin');

        }

        $this->load->model("admin/Role_Rights_model");

        $this->load->database();



    }



    public function index() {

        //$dte['he'] = "hello";

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        

        //$this->load->view ('home', $data);

        $company = $this->Role_Rights_model->select_data_roles($this->session->userdata('id_admin')); 

        $data['company'] = $company;

        $this->load->view('admin/role_rights',$data);

    }



    public function add() {
        /*echo "<pre>";
        print_r($_POST);*/

if($_POST)

{

$now = date("Y-m-d H:i:s");

        

                   

                    $newdata = [];

                    $data = [];

                    //secho "<pre>";

                 $vali = '';

                 $vald = '';

                 $vale = '';

                 $vala = '';

                 $i = 0;


        foreach ($_POST['controller'] as $key => $value) {

                    

                   // print_r($_POST[$key]);exit();
                    

                    if(!empty($_POST[$key]))

                    {   
                        //echo "if";exit();

                          if (array_key_exists("index", $_POST[$key]))

                          {
                            
                                $vali = '1';

                          }

                          else

                          {
                            
                                $vali = '0';

                          }


                          if (array_key_exists("edit", $_POST[$key]))

                          {

                                $vale = '1';

                          }

                          else

                          {

                                $vale = '0';

                          }

                          if (array_key_exists("add", $_POST[$key]))

                          {

                                $vala = '1';

                          }

                          else

                          {

                                $vala = '0';

                          }

                          if (array_key_exists("delete", $_POST[$key]))

                          {

                                $vald = '1';

                          }

                          else

                          {

                                $vald = '0';

                          }



                          $data[$i] = array(



                                'tbl_role_rights_role_id' => $this->input->post('company_id'),



                                'tbl_role_rights_page_name' => $key,



                                'tbl_role_rights_view' => $vali,



                                'tbl_role_rights_add' => $vala,



                                'tbl_role_rights_edit' =>  $vale,



                                'tbl_role_rights_delete' => $vald,



                                'tbl_role_rights_insertdate' => $now,



                               );



                          //print_r($data);exit;



                          //$result = $this->Role_Rights_model->insert_master_child($data);

                    }

                    else

                    {
                      //echo "else";exit();

                        $data[$i] = array(



                        'tbl_role_rights_role_id' => $this->input->post('company_id'),



                        'tbl_role_rights_page_name' => $key,



                        'tbl_role_rights_view' => '0',



                        'tbl_role_rights_add' => '0',



                        'tbl_role_rights_edit' =>  '0',



                        'tbl_role_rights_delete' => '0',



                        'tbl_role_rights_insertdate' => $now,



                       ); 

                        

                        //$datanew[$key] = array('delete' => 0, 'add' => 0,'edit' => 0, 'index' => 0);

                    }

         $i++;          

        }

/*echo "<pre>";

        print_r($data);exit;*/
        $result = $this->Role_Rights_model->insert_master_child($data);

        //exit;

                    //print_r($result);exit;



                    //print_r($datanew);

                    /*foreach ($datanew as $keyee => $valueee) {

                        # code...

                    echo $keyee;

                    $data = array(



                                            'tbl_role_rights_role_id' => $this->input->post('company_id'),



                                            'tbl_role_rights_page_name' => $keyee,



                                            'tbl_role_rights_view' => $this->input->post('index'),



                                            'tbl_role_rights_add' => $this->input->post('add'),



                                            'tbl_role_rights_edit' =>  $this->input->post('edit'),



                                            'tbl_role_rights_delete' => $this->input->post('delete'),



                                            'tbl_role_rights_insertdate' => $now,



                                        ); 

                    }*/

                    //$result = $this->Role_Rights_model->insert_master_child($data);

                 if($result == 1) {

                    $this->session->set_flashdata('success', 'Data Inserted Successfully!');

                    redirect('admin/role_rights');

                }

                elseif($result == 0) {

                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');

                    redirect('admin/role_rights');

                }

                /*exit();

                if($_POST)

                    {

                        $now = date("Y-m-d H:i:s");

                       

                            $data = array(



                                'tbl_role_rights_role_id' => $this->input->post('company_id'),



                                'tbl_role_rights_page_name' => $this->input->post('controller'),



                                'tbl_role_rights_view' => $this->input->post('index'),



                                'tbl_role_rights_add' => $this->input->post('add'),



                                'tbl_role_rights_edit' =>  $this->input->post('edit'),



                                'tbl_role_rights_delete' => $this->input->post('delete'),



                                'tbl_role_rights_insertdate' => $now,



                            ); 

                            $result = $this->Role_Rights_model->insert_master_child($data);

                        

                        

                        

                       // print_r($data);exit;

                        

                        if($result == 2) {

                            $this->session->set_flashdata('success', 'Data Updated Successfully!');

                            redirect('admin/role_rights');

                        } else if($result == 1) {

                            $this->session->set_flashdata('success', 'Data Inserted Successfully!');

                            redirect('admin/role_rights');

                        }

                        elseif($result == 0) {

                            $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');

                            redirect('admin/role_rights');

                        }

                    }*/

        }

    }



    public function showuser() {

        //print_r($_POST);

        $utype = $this->input->post('usertypes');

        //echo "this is u".$i;exit;

        $editdte = $this->Role_Rights_model->select_data_user($utype); 

        /*$data['header'] = $this->load->view('includes/header', NULL, TRUE);

        $data['sidebar'] = $this->load->view('admin/includes/sidebar', NULL, TRUE);

        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);*/

        //$data['userdt'] = $editdt;



        echo $editdte;

        //$this->load->view ('home', $data);

    }



    public function show_data_child() {

        //print_r($_POST);

        $utype = $this->input->post('childuser');

        //echo "this is u".$i;exit;

        $editdte = $this->Role_Rights_model->select_data_child_user($utype); 

        /*$data['header'] = $this->load->view('includes/header', NULL, TRUE);

        $data['sidebar'] = $this->load->view('admin/includes/sidebar', NULL, TRUE);

        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);*/

        //$data['userdt'] = $editdt;



        echo $editdte;

        //$this->load->view ('home', $data);

    }





    



}

