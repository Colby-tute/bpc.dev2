<?php defined('BASEPATH') OR exit('No direct script access allowed');



date_default_timezone_set('Africa/Johannesburg');

class Todo_n_task extends MY_Controller

{



    function __construct()

    {

        parent::__construct();



         if(empty($this->session->userdata('id_admin'))) {

            $this->session->set_flashdata('flash_data', 'You don\'t have Of Pages');

            redirect('admin/masterlogin');

        }

        $this->load->model("admin/Todo_n_task_Modal");

        $this->load->database();



    }



    public function index() {

        

        //echo "string";exit();

        $result = $this->Todo_n_task_Modal->View_Application();

        $data['view_data'] = $result;



        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);



        $this->load->view('admin/todo_n_task/index',$data);

    }



    public function add() {



        if ($_POST) {

            //print_r($_POST);exit();

            $now = date("Y-m-d H:i:s");

            //print_r($_FILES);
            $select_smme_per = $this->Todo_n_task_Modal->select_smme_per($this->session->post('smme_id'));

            $business_doc = str_replace(" ", "_",$_FILES['business_doc']['name']);

            $business_doc_new = "business_document_".$select_smme_per[0]->tbl_users_id."_".$business_doc;



            $motivation_letter = str_replace(" ", "_", $_FILES['motivation_letter']['name']);

            $motivation_letter_new = "motivation_letter_".$select_smme_per[0]->tbl_users_id."_".$motivation_letter;



            

            //print_r($motivation_letter_new);



            $data = array(



                'tbl_application_incubator_id' => $this->input->post('incubator_id'),



                'tbl_application_bdsp_id' => $this->input->post('bdsp_id'),



                'tbl_application_smme_id' => $this->session->post('smme_id'),



                'tbl_application_business_doc' => $business_doc_new,



                'tbl_application_motivation_text' => $this->input->post('motivation_text'),



                'tbl_application_motivation_letter' => $motivation_letter_new,



                'tbl_application_status' => 'Applied',



                'tbl_application_insertdate' => $now,

            );

            //exit;

            $result = $this->Todo_n_task_Modal->Insert_Application($data);



            if ($result == 1) {



                if(!empty($_FILES['business_doc']['name'])){



                    $_FILES['file']['name'] = $business_doc_new;

                    $_FILES['file']['type'] = $_FILES['business_doc']['type'];

                    $_FILES['file']['tmp_name'] = $_FILES['business_doc']['tmp_name'];

                    $_FILES['file']['error'] = $_FILES['business_doc']['error'];

                    $_FILES['file']['size'] = $_FILES['business_doc']['size'];

          

                    $config['upload_path'] = 'assets/Application/Business_Document'; 

                    $config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';

                    //$config['max_size'] = '5000';

                    $config['client_name'] = $business_doc_new;

           

                    $this->load->library('upload',$config); 

            

                    if($this->upload->do_upload('file')){

                        $uploadData = $this->upload->data();

                        /*$filename = $uploadData['client_name'];

                        $data1['totalFiles'][] = $filename;*/

                    }

                }

                    

                if(!empty($_FILES['motivation_letter']['name'])){



                    $_FILES['file']['name'] = $motivation_letter_new;

                    $_FILES['file']['type'] = $_FILES['motivation_letter']['type'];

                    $_FILES['file']['tmp_name'] = $_FILES['motivation_letter']['tmp_name'];

                    $_FILES['file']['error'] = $_FILES['motivation_letter']['error'];

                    $_FILES['file']['size'] = $_FILES['motivation_letter']['size'];

          

                    $config1['upload_path'] = 'assets/Application/Motivation_Letter'; 

                    $config1['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';

                    //$config['max_size'] = '5000';

                    $config1['client_name'] = $motivation_letter_new;

           

                    $this->load->library('upload',$config1); 

                    //$this->upload->initialize($config1);

                    if($this->upload->do_upload('file')){

                        $uploadData = $this->upload->data();

                       /* $filename = $uploadData['client_name'];

                        $data2['totalFiles'][] = $filename;*/

                    }

                }

                $this->session->set_flashdata("success","Application is Inserted Successfully!!!"); 

                redirect('admin/smme/application'); 

            }

            else{

                $this->session->set_flashdata("danger","Application is Not Inserted Successfully!!!"); 

                redirect('admin/smme/application'); 

            }

        }



        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);



        $select_incubator = $this->Todo_n_task_Modal->select_incubator();

        $data['select_incubator'] = $select_incubator;



        $select_bdsp = $this->Todo_n_task_Modal->select_bdsp();

        $data['select_bdsp'] = $select_bdsp;



        $select_smme = $this->Todo_n_task_Modal->select_smme();

        $data['select_smme'] = $select_smme;



        $this->load->view('admin/smme/application/add',$data);

    }



    public function edit($id) {



        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);



        $result = $this->Todo_n_task_Modal->Edit_Application($id);

        $data['edit_data'] = $result;



        $select_incubator = $this->Todo_n_task_Modal->select_incubator();

        $data['select_incubator'] = $select_incubator;



        $select_bdsp = $this->Todo_n_task_Modal->select_bdsp();

        $data['select_bdsp'] = $select_bdsp;



        $select_smme = $this->Todo_n_task_Modal->select_smme();

        $data['select_smme'] = $select_smme;



        $this->load->view('admin/smme/application/edit',$data);



    }



    public function update($id) {



        /*print_r($_POST);

        print_r($_FILES);*/



        if ($_FILES['business_doc']['name'] == '') {

            

            $business_doc_new = $this->input->post('old_business_doc');

        }

        else{



            $business_doc = str_replace(" ", "_",$_FILES['business_doc']['name']);

            $business_doc_new = "business_document_".$this->session->userdata('user_unique_id')."_".$business_doc;

        }



        if ($_FILES['motivation_letter']['name'] == '') {

            

            $motivation_letter_new = $this->input->post('old_motivation_letter');

        }

        else{

             $select_smme_per = $this->Todo_n_task_Modal->select_smme_per($this->session->post('smme_id'));

            $business_doc = str_replace(" ", "_",$_FILES['business_doc']['name']);

            $business_doc_new = "business_document_".$select_smme_per[0]->tbl_users_id."_".$business_doc;



            $motivation_letter = str_replace(" ", "_", $_FILES['motivation_letter']['name']);

            $motivation_letter_new = "motivation_letter_".$select_smme_per[0]->tbl_users_id."_".$motivation_letter;


        }



        //print_r($motivation_letter_new);

        $data = array(



            'tbl_application_incubator_id' => $this->input->post('incubator_id'),



            'tbl_application_bdsp_id' => $this->input->post('bdsp_id'),



            'tbl_application_business_doc' => $business_doc_new,



            'tbl_application_motivation_text' => $this->input->post('motivation_text'),



            'tbl_application_motivation_letter' => $motivation_letter_new,

        );



        $result = $this->Todo_n_task_Modal->Update_Application($data,$id);



        if ($result == 1) {



            if(!empty($_FILES['business_doc']['name'])){



                //unlink('assets/Application/Business_Document/'.$this->input->post('old_business_doc'));



                $_FILES['file']['name'] = $business_doc_new;

                $_FILES['file']['type'] = $_FILES['business_doc']['type'];

                $_FILES['file']['tmp_name'] = $_FILES['business_doc']['tmp_name'];

                $_FILES['file']['error'] = $_FILES['business_doc']['error'];

                $_FILES['file']['size'] = $_FILES['business_doc']['size'];

      

                $config['upload_path'] = 'assets/Application/Business_Document'; 

                $config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';

                //$config['max_size'] = '5000';

                $config['client_name'] = $business_doc_new;

       

                $this->load->library('upload',$config); 

        

                if($this->upload->do_upload('file')){

                    $uploadData = $this->upload->data();

                }

            }

                    

            if(!empty($_FILES['motivation_letter']['name'])){



                //unlink('assets/Application/Motivation_Letter/'.$this->input->post('old_motivation_letter'));



                $_FILES['file']['name'] = $motivation_letter_new;

                $_FILES['file']['type'] = $_FILES['motivation_letter']['type'];

                $_FILES['file']['tmp_name'] = $_FILES['motivation_letter']['tmp_name'];

                $_FILES['file']['error'] = $_FILES['motivation_letter']['error'];

                $_FILES['file']['size'] = $_FILES['motivation_letter']['size'];

      

                $config1['upload_path'] = 'assets/Application/Motivation_Letter'; 

                $config1['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';

                //$config['max_size'] = '5000';

                $config1['client_name'] = $motivation_letter_new;

       

                $this->load->library('upload',$config1); 

                //$this->upload->initialize($config1);

                if($this->upload->do_upload('file')){

                    $uploadData = $this->upload->data();

                }

            }

            $this->session->set_flashdata("success","Application is Updated Successfully!!!"); 

            redirect('admin/smme/application'); 

        }

        else{



            $this->session->set_flashdata("danger","Application is Not Updated Successfully!!!"); 

            redirect('admin/smme/application'); 

        }

    }



    public function delete($id) {



        $result = $this->Todo_n_task_Modal->Delete_Application($id);



        if ($result == 1) {



            $this->session->set_flashdata("success","Application is Deleted Successfully!!!"); 

            redirect('admin/smme/application'); 

        }

        else{



            $this->session->set_flashdata("danger","Application is Not Deleted Successfully!!!"); 

            redirect('admin/smme/application'); 

        }

    }

    public function view($app_id,$id) {

        //echo $app_id.'-'.$id;exit;

        $data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

        $personal = $this->Todo_n_task_Modal->select_user_personal_data($id);

        $data['personal'] = $personal;

        $userdt = $this->Todo_n_task_Modal->select_user_data($id);

        $data['userdt'] = $userdt;

        $business = $this->Todo_n_task_Modal->select_user_business_data($id);
        $data['business'] = $business;

        $smme_teams = $this->Todo_n_task_Modal->select_smme_teams_data($id);
        $data['smme_teams'] = $smme_teams;

        $result = $this->Todo_n_task_Modal->Edit_Application($app_id);
        $data['edit_data'] = $result;

        $select_mul_doc = $this->Todo_n_task_Modal->select_mul_doc_id($app_id);
        $data['select_mul_doc'] = $select_mul_doc;

        $bdsp_incubator_smme_name = $this->Todo_n_task_Modal->bdsp_incubator_smme_name($app_id);
        $data['bdsp_incubator_smme_name'] = $bdsp_incubator_smme_name;  
        
        $this->load->view('admin/smme/application/view',$data);
    }

}

