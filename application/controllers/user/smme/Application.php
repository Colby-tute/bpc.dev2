<?php defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Africa/Johannesburg');
class Application extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("smme/Application_Modal");
        $this->load->database();

    }

    public function get_bdsps() {
        // $sql = "SELECT bdsp_id FROM tbl_application_assignment WHERE smme_id=". $this->session->userdata("id_user") . " and bdsp_id is not null" ;
        $sql = "SELECT u.tbl_users_id as user_id, aa.bdsp_id, u.tbl_users_firstname, u.tbl_users_lastname FROM tbl_application_assignment aa, tbl_users u WHERE aa.bdsp_id = u.tbl_users_id and aa.bdsp_id is not null and aa.smme_id=". $this->session->userdata("id_user"); 
        $bdsps = $this->db->query($sql)->result();
        return $bdsps;
    }

    public function get_incubator() {
        // $sql = "SELECT incubator_id FROM tbl_application_assignment WHERE smme_id=". $this->session->userdata("id_user") . " and incubator_id is not null" ;
        $sql = "SELECT aa.incubator_id, u.tbl_users_firstname, u.tbl_users_lastname FROM tbl_application_assignment aa, tbl_users u WHERE aa.incubator_id = u.tbl_users_id and aa.incubator_id is not null and aa.smme_id=".$this->session->userdata("id_user"); 
        $incubator = $this->db->query($sql)->result();
        return $incubator;
    }

    public function index() {
        
        //echo "string";exit();
        $result = $this->Application_Modal->View_Application();
        /*if (count($result) == 0) {
            redirect(site_url('user/smme/Application/add'), 'refresh');
        }*/
        $data['view_data'] = $result;

        $data['bdsps'] = $this->get_bdsps();
        $data['incubator'] = $this->get_incubator();

        $this->db->select("stage, tbl_stages.id as id");
        $this->db->join("tbl_stages", "tbl_users.tbl_users_status=tbl_stages.id", "LEFT");
        $this->db->where("tbl_users_id", $this->session->userdata("id_user"));
        $query = $this->db->get("tbl_users");
        $res = $query->result();
        $data['user_status'] = count($query->result()) > 0 ? $query->result()[0]->stage : '';
        $data['status_id'] = count($query->result()) > 0 ? $query->result()[0]->id : '';
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

        $this->load->view('user/smme/application/index',$data);
    }

    public function add() {
	
        if ($_POST) {

            $now = date("Y-m-d H:i:s");
           
            $motivation_letter = str_replace(" ", "_", $_FILES['motivation_letter']['name']);
            $motivation_letter_new = "motivation_letter_".$this->session->userdata('user_unique_id')."_".$motivation_letter;

            $data = array(

                'tbl_application_incubator_id' => $this->input->post('incubator_id'),

                'tbl_application_bdsp_id' => $this->input->post('bdsp_id'),

                'tbl_application_smme_id' => $this->session->userdata('id_user'),

                'tbl_application_motivation_letter' => $motivation_letter_new,

                'tbl_application_status' => 'Pending Approval',

                'tbl_application_insertdate' => $now,
            );

            /*$data1 = array(
                'tbl_business_document_title' =>  $_FILES['business_doc']['name'],

                'tbl_business_document_document' => $_FILES['business_doc']['name'],
            );*/
            $bus_mul_doc_new = [];

             if($_POST['checked_doc'] != '')
             {
                $exp = explode(',', $_POST['checked_doc']);
             }
             foreach ($exp as $key => $value) 
             {
                if($value != '')
                {
                  $bus_mul_doc_new[] =  $value;
                }
                
             }
        $data2 = array(

            'tbl_business_document_document' => $bus_mul_doc_new,
        );
            //exit;
            $result = $this->Application_Modal->Insert_Application($data,/*$data1,*/$data2);

            if ($result == 1) {

                $count = count($_FILES['business_doc']['name']);

                for ($i=0; $i < $count; $i++) { 

                    $business_doc = str_replace(" ", "_",$_FILES['business_doc']['name'][$i]);
                    $business_doc_new = "business_document_".$this->session->userdata('user_unique_id')."_".$business_doc;

                    if(!empty($_FILES['business_doc']['name'][$i])){

                        $_FILES['file']['name'] = $business_doc_new;
                        $_FILES['file']['type'] = $_FILES['business_doc']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['business_doc']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['business_doc']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['business_doc']['size'][$i];
              
                        $config['upload_path'] = 'assets/Application/Business_Document'; 
                        $config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';
                        //$config['max_size'] = '5000';
                        $config['client_name'] = $business_doc_new;
               
                        $this->load->library('upload',$config); 
                
                        if($this->upload->do_upload('file')){
                            $uploadData = $this->upload->data();
                        }
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
                    $this->upload->initialize($config1);
                    if($this->upload->do_upload('file')){
                        $uploadData = $this->upload->data();                       
                    }
                }
                $this->session->set_flashdata("success","This application has been processed successfully!!!"); 
                redirect('user/smme/Application'); 
            }
            else{
                $this->session->set_flashdata("danger","There was a problem processing this application!!!"); 
                redirect('user/smme/Application'); 
            }
        }

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

        $select_incubator = $this->Application_Modal->select_incubator();
        $data['select_incubator'] = $select_incubator;

        $select_bdsp = $this->Application_Modal->select_bdsp();
        $data['select_bdsp'] = $select_bdsp;

         $business_doc = $this->Application_Modal->select_business_docs($this->session->userdata('id_user'));

        $data['business_doc'] = $business_doc;
		
        $this->db->where("tbl_users_id", $this->session->userdata('id_user'));
        $this->db->update("tbl_users", [
            "tbl_users_status" => "3"
        ]);
        $smme_id = $this->session->userdata('id_user');


        // //to insert questions for each smme on application
        // this function is added when admin approves the application. so removed here.
        // $this->db->where("user_id", $smme_id);
        // $count = $this->db->get("tbl_smme_question_answer")->num_rows();

        // if ($count == 0) {
        //     $query = $this->db->get('tbl_phase_question');
        //     foreach ($query->result() as $row) {
        //           $rowdata = array (
        //             'user_id' => $smme_id,
        //             'phase_id' => $row->phase_id,
        //             'subphase_id' => $row->sub_phase_id,
        //             'question_text' => $row->question,
        //             'is_answered' => 0,
        //             'is_deleted' => 0
        //           );
        //           $this->db->insert('tbl_smme_question_answer',$rowdata);
        //     }
        // }



        $this->load->view('user/smme/application/add',$data);
    }

    public function edit($id) {

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

        $result = $this->Application_Modal->Edit_Application($id);
        $data['edit_data'] = $result;

        $select_mul_doc = $this->Application_Modal->select_mul_doc_id($id);
        $data['select_mul_doc'] = $select_mul_doc;

        $select_incubator = $this->Application_Modal->select_incubator();
        $data['select_incubator'] = $select_incubator;

        $select_bdsp = $this->Application_Modal->select_bdsp();
        $data['select_bdsp'] = $select_bdsp;


        $business_doc = $this->Application_Modal->select_business_docs($this->session->userdata('id_user'));

        $data['business_doc'] = $business_doc;

        $this->load->view('user/smme/application/edit',$data);

    }

    public function update($id) {

        /*$bus_mul_doc = $_FILES['business_doc']['name'];
       
             $bus_mul_doc_new = [];

             if($_POST['checked_doc'] != '')
             {
                $exp = explode(',', $_POST['checked_doc']);
             }
             foreach ($exp as $key => $value) 
             {
                if($value != '')
                {
                  $bus_mul_doc_new[] =  $value;
                }
                
             }*/

        if ($_FILES['motivation_letter']['name'] == '') {
            
            $motivation_letter_new = $this->input->post('old_motivation_letter');
        }
        else{

            $motivation_letter = str_replace(" ", "_", $_FILES['motivation_letter']['name']);
            $motivation_letter_new = "motivation_letter_".$this->session->userdata('user_unique_id')."_".$motivation_letter;
        }

        $data = array(

            'tbl_application_incubator_id' => $this->input->post('incubator_id'),

            'tbl_application_bdsp_id' => $this->input->post('bdsp_id'),

            'tbl_application_motivation_letter' => $motivation_letter_new,
        );

        /*$data1 = array(
            
            'tbl_business_document_title' =>  $bus_mul_doc,

            'tbl_business_document_document' => $bus_mul_doc,
        );*/

        /*$data2 = array(

            'tbl_business_document_document' => $bus_mul_doc_new,
        );*/
    
        $result = $this->Application_Modal->Update_Application($data,$id);

        if ($result == 1) {

            $count = count($_FILES['business_doc']['name']);

            for ($i=0; $i < $count; $i++) { 

                $business_doc = str_replace(" ", "_",$_FILES['business_doc']['name'][$i]);
                $business_doc_new = "business_document_".$this->session->userdata('user_unique_id')."_".$business_doc;

                if(!empty($_FILES['business_doc']['name'][$i])){

                    $_FILES['file']['name'] = $business_doc_new;
                    $_FILES['file']['type'] = $_FILES['business_doc']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['business_doc']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['business_doc']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['business_doc']['size'][$i];
          
                    $config['upload_path'] = 'assets/Application/Business_Document'; 
                    $config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';
                    $config['client_name'] = $business_doc_new;
           
                    $this->load->library('upload',$config); 
            
                    if($this->upload->do_upload('file')){
                        $uploadData = $this->upload->data();
                    }
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
                
                $config1['client_name'] = $motivation_letter_new;
       
                $this->load->library('upload',$config1); 
               
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                }
            }
            $this->session->set_flashdata("success","The application has been updated successfully!!!"); 
            redirect('user/smme/Application'); 
        }
        else{

            $this->session->set_flashdata("success","There was a problem updating the application!!!"); 
            redirect('user/smme/Application'); 
            /*$this->session->set_flashdata("danger","Application is Not Updated Successfully!!!"); 
            redirect('user/smme/Application'); */
        }
    }

    public function delete($id) {

        $result = $this->Application_Modal->Delete_Application($id);

        if ($result == 1) {

            $this->session->set_flashdata("success","The application has been deleted successfully!!!"); 
            redirect('user/smme/Application'); 
        }
        else{

            $this->session->set_flashdata("danger","Application is Not Deleted Successfully!!!"); 
            redirect('user/smme/Application'); 
        }
    }
}
