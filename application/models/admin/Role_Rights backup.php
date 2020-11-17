<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Role_Rights extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('id_admin'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('user');
        }
        $this->load->model("Role_Rights_model");
        $this->load->database();

    }

    public function index() {
        //$dte['he'] = "hello";
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['sidebar'] = $this->load->view('includes/sidebar', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        
        //$this->load->view ('home', $data);
        $company = $this->Role_Rights_model->select_data_roles($this->session->userdata('id_admin')); 
        $data['company'] = $company;
        $this->load->view('role_rights',$data);
    }

    public function add() {
       // print_r($_POST);
if($_POST)
{
$now = date("Y-m-d H:i:s");
        
                   
                    $newdata = [];
                    $data = [];
                    //secho "<pre>";
        foreach ($_POST['controller'] as $key => $value) {
                    
                   // print_r($value);
                    
                    if(!empty($_POST[$value]))
                    {    $vali = 0;
                         $vald = 0;
                         $vale = 0;
                         $vala = 0;
                        foreach ($_POST[$value] as $keys => $values) 
                        {
                            //echo $key;
                           // print_r($keys);
                            if($keys == 'index')
                            {

                                $vali = $values;

                            }
                        
                            if($keys == 'edit')
                            {

                               $vale = $values;

                            }
                            
                            if($keys == 'add')
                            {

                               $vala = $values;

                            }
                            
                            if($keys == 'delete')
                            {

                                $vald = $values;

                            }
                            


                            //$datanew[$key] = array('delete' => $vald, 'add' => $vala,'edit' => $vale, 'index' => $vali);
                             $data = array(

                                'tbl_role_rights_role_id' => $this->input->post('company_id'),

                                'tbl_role_rights_page_name' => $key,

                                'tbl_role_rights_view' => $vali,

                                'tbl_role_rights_add' => $vala,

                                'tbl_role_rights_edit' =>  $vale,

                                'tbl_role_rights_delete' => $vald,

                                'tbl_role_rights_insertdate' => $now,

                               );

                            /* print_r($data);*/
                        }
                         //print_r($data);
                        $result = $this->Role_Rights_model->insert_master_child($data);
                        // $result = $this->Role_Rights_model->insert_master_child($data);
                    }
                    else
                    {
                        $data = array(

                        'tbl_role_rights_role_id' => $this->input->post('company_id'),

                        'tbl_role_rights_page_name' => $key,

                        'tbl_role_rights_view' => 0,

                        'tbl_role_rights_add' => 0,

                        'tbl_role_rights_edit' =>  0,

                        'tbl_role_rights_delete' => 0,

                        'tbl_role_rights_insertdate' => $now,

                       ); 
                        $result = $this->Role_Rights_model->insert_master_child($data);
                        //$datanew[$key] = array('delete' => 0, 'add' => 0,'edit' => 0, 'index' => 0);
                    }
                    

                    
        }
                    //print_r($data);exit;

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
                if($result == 2) {
                    $this->session->set_flashdata('success', 'Data Updated Successfully!');
                    redirect('role_rights');
                } else if($result == 1) {
                    $this->session->set_flashdata('success', 'Data Inserted Successfully!');
                    redirect('role_rights');
                }
                elseif($result == 0) {
                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');
                    redirect('role_rights');
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
                            redirect('role_rights');
                        } else if($result == 1) {
                            $this->session->set_flashdata('success', 'Data Inserted Successfully!');
                            redirect('role_rights');
                        }
                        elseif($result == 0) {
                            $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');
                            redirect('role_rights');
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
        $data['sidebar'] = $this->load->view('includes/sidebar', NULL, TRUE);
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
        $data['sidebar'] = $this->load->view('includes/sidebar', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);*/
        //$data['userdt'] = $editdt;

        echo $editdte;
        //$this->load->view ('home', $data);
    }


    

}
