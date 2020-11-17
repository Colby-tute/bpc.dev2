<?php defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Africa/Johannesburg');
class BusinessDetails extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('Login');
        }

        $this->load->model("bdsp/BusinessDetails_Modal");
        $this->load->database();

    }

    public function index() {

        $id = $this->session->userdata('id_user');

        $business = $this->BusinessDetails_Modal->select_user_business_data($id);
        $smme_teams = $this->BusinessDetails_Modal->select_smme_teams_data($id);
        $business_doc = $this->BusinessDetails_Modal->select_business_docs($id);
        $role = $this->BusinessDetails_Modal->select_all_role();

        $industrys = $this->BusinessDetails_Modal->select_industry();
        $data['industrys'] = $industrys;
        
        $data['role'] = $role;
        $data['business'] = $business;
        $data['smme_teams'] = $smme_teams;
        $data['business_doc'] = $business_doc;
					 
      
	   // $query = $this->db->query("SELECT tbl_all_documents.tbl_all_documents_title as title,tbl_all_documents.tbl_all_documents_document as document FROM tbl_all_documents,tbl_application_assignment WHERE tbl_all_documents.upload_for = tbl_application_assignment.smme_id and tbl_application_assignment.bdsp_id={$id} and tbl_all_documents.tbl_all_documents_type='B'");
       
       /* $this->db->where("bdsp_id", $id);
        $query = $this->db->get("tbl_application_assignment");
        $result = $query->result();
		$incu_doc=[];
		foreach($result as $row){
			$msmeid=$row->smme_id;
			$this->db->where("upload_for", $msmeid);
			$this->db->where("tbl_all_documents_type", "B");
			$query = $this->db->get("tbl_all_documents");
			$result2 = $query->result();
			foreach($result2 as $row2){
				$incu_doc["tbl_all_documents_title"][]=$row2->tbl_all_documents_title;
				$incu_doc["tbl_all_documents_document"][]=$row2->tbl_all_documents_document;
				
			}
			
		}*/
		//$data['incu_doc']=$query->result();

        $data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

        $this->db->select("*");
        $this->db->where("user_id", $this->session->userdata("id_user"));
        $data['partners'] = $this->db->get("tbl_user_partner")->result();

        $this->load->view('bdsp/business_details/edit',$data);
    }

    public function add_partner($user_id)
    {
        $this->db->insert("tbl_user_partner", $_POST);

        redirect("bdsp/BusinessDetails");
    }

    public function update_service($upd_id) {
        $query = $this->db->query("SELECT tbl_business_details_user_id FROM tbl_business_details WHERE tbl_business_details_user_id = {$upd_id} LIMIT 1");
        if ($query->num_rows() == 0) {
            $this->db->insert("tbl_business_details", [
                "product_service" => $this->input->post("product_service"),
                "tbl_business_details_user_id" => $this->session->userdata("id_user")
            ]);
        } else {
            $this->db->where("tbl_business_details_user_id", $upd_id);
            $this->db->update("tbl_business_details", [
                "product_service" => $this->input->post("product_service"),
            ]);
        }

        redirect("bdsp/BusinessDetails");
    }

    public function get_sub_industries() {

        $ind_id = $this->input->post('ind_id');

        $sub_industries = $this->BusinessDetails_Modal->sub_industries($ind_id);

        echo json_encode($sub_industries);
    }

    public function update($upd_id) {

		if($_POST)
		{
			$now = date("Y-m-d H:i:s");
			$randomid = mt_rand(100000,999999); 
			//echo $randomid;
			
			if($_FILES['tbl_business_details_business_logo']['name'] != "")
			{
				$image_replace = str_replace(" ", "_",$_FILES['tbl_business_details_business_logo']['name']);
				//$image_replace = str_replace(".", "_", $image_replace);
				$image_name = "business_logo_photo_".$randomid."_".$image_replace;
				
				if(!empty($_FILES['tbl_business_details_business_logo']['name'])){
		   
					$_FILES['file']['name'] = $image_name;
					$_FILES['file']['type'] = $_FILES['tbl_business_details_business_logo']['type'];
					$_FILES['file']['tmp_name'] = $_FILES['tbl_business_details_business_logo']['tmp_name'];
					$_FILES['file']['error'] = $_FILES['tbl_business_details_business_logo']['error'];
					$_FILES['file']['size'] = $_FILES['tbl_business_details_business_logo']['size'];
		  
					$config['upload_path'] = 'assets/users'; 
					$config['allowed_types'] = 'jpg|jpeg|png|tiff';
					//$config['max_size'] = '5000';
					$config['client_name'] = $image_name;
		   
					$this->load->library('upload',$config); 
			
					
                        if($this->upload->do_upload('file')){
                        $uploadData = $this->upload->data();
                        }
                        else{
                            $this->session->set_flashdata('danger',$this->upload->display_errors());
                            return redirect(site_url('bdsp/BusinessDetails'));
                        }
				}
			}
			else
			{
				$image_name = $this->input->post('tbl_business_details_business_logo_old');
			}

			$business = array(

					 'tbl_business_details_name' => $this->input->post('tbl_business_details_name'),

					'tbl_business_details_desc' => trim($this->input->post('tbl_business_details_desc')),

					 'tbl_business_details_industry' => $this->input->post('tbl_business_details_industry'),

					 'tbl_business_details_sub_industry' => $this->input->post('tbl_business_details_subindustry'),

					 'tbl_business_details_email' => $this->input->post('tbl_business_details_email'),

					'tbl_business_details_countrycode'=> $this->input->post('country_code'),
					
					 'tbl_business_details_phone'=> $this->input->post('tbl_business_details_phone'),

					 'tbl_business_details_district'=> $this->input->post('tbl_business_details_district'),

					 'tbl_business_details_town_village'=> $this->input->post('tbl_business_details_town_village'),

					 'tbl_business_details_employees'=> $this->input->post('tbl_business_details_employees'),

					 'tbl_business_details_date_hired'=> $this->input->post('tbl_business_details_date_hired'),

					 'tbl_business_details_gender'=> $this->input->post('tbl_business_details_gender'),

					 'tbl_business_details_investmant_need'=> $this->input->post('tbl_business_details_investmant_need'),

					 'tbl_business_details_areyouteam'=> $this->input->post('tbl_business_details_areyouteam'),
					 
					 'tbl_business_details_business_logo'=> $image_name,
				); 
                $result = $this->BusinessDetails_Modal->update_master($business,$upd_id,$this->input->post('tbl_business_details_id'));
               
                // $smme_teams = array(

                //      'tbl_smme_teams_first_name' => $this->input->post('tbl_smme_teams_first_name'),

                //      'tbl_smme_teams_last_name' => $this->input->post('tbl_smme_teams_last_name'),

                //      'tbl_smme_teams_email' => $this->input->post('tbl_smme_teams_email'),

                //      'tbl_smme_teams_mobile'=> $this->input->post('tbl_smme_teams_mobile'),

                //      'tbl_smme_teams_insertdate'=> $now,

                // );

                // $result2 = $this->BusinessDetails_Modal->update_master($business,$smme_teams,$upd_id,$this->input->post('tbl_business_details_id'));

                $resultData = explode('^', $result);
                if($resultData == 1) {
                        if($_FILES['tbl_business_details_business_doc']['name'] != "")
                        {
                            $image_replace = str_replace(" ", "_",$_FILES['tbl_business_details_business_doc']['name']);
                            $image_name = "business_doc_photo_".$randomid."_".$image_replace;
                            $images = array(
                                'tbl_business_details_business_doc' => $image_name,
                            ); 
                            $this->BusinessDetails_Modal->image_insert($images,$upd_id,'tbl_business_details','tbl_business_details_user_id');

                            if(!empty($_FILES['tbl_business_details_business_doc']['name'])){
                       
                                $_FILES['file']['name'] = $image_name;
                                $_FILES['file']['type'] = $_FILES['tbl_business_details_business_doc']['type'];
                                $_FILES['file']['tmp_name'] = $_FILES['tbl_business_details_business_doc']['tmp_name'];
                                $_FILES['file']['error'] = $_FILES['tbl_business_details_business_doc']['error'];
                                $_FILES['file']['size'] = $_FILES['tbl_business_details_business_doc']['size'];
                      
                                $config['upload_path'] = 'assets/users'; 
                                $config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';
                                $config['max_size'] = '5000';
                                $config['client_name'] = $image_name;
                       
                                $this->load->library('upload',$config); 
                        
                                if($this->upload->do_upload('file')){
                                    $uploadData = $this->upload->data();
                                }
                            }
                        }
                        $this->session->set_flashdata('success', 'Data Inserted Successfully!');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                elseif($resultData == 0) {
                    $this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
    }

    public function insert_business_doc() {

    	/*print_r($_POST);
    	print_r($_FILES);exit;*/

    	$now = date("Y-m-d H:i:s");
       /* $count = count($_FILES['business_doc_files']['name']);
        for ($i=0; $i < $count; $i++) { 
*/

    	$business_doc = str_replace(" ", "_",$_FILES['business_doc_files']['name']);
        $business_doc_new = "business_document_".$this->session->userdata('user_unique_id')."_".$business_doc;

    	$data = array(
    		'tbl_all_documents_user_id' => $this->session->userdata('id_user'),

    		//'tbl_business_document_businessid' => $this->input->post('tbl_business_details_id'),

    		'tbl_all_documents_title' => $this->input->post('business_doc_title'),

    		'tbl_all_documents_document' => $business_doc_new,

            'tbl_all_documents_type' => 'B',

    		'tbl_all_documents_insertdate' => $now,
    	);

    	$result = $this->BusinessDetails_Modal->insert_business_doc($data);
       /*}*/
    	if ($result == 1) {

            if(!empty($_FILES['business_doc_files']['name'])){

                $_FILES['file']['name'] = $business_doc_new;
                $_FILES['file']['type'] = $_FILES['business_doc_files']['type'];
                $_FILES['file']['tmp_name'] = $_FILES['business_doc_files']['tmp_name'];
                $_FILES['file']['error'] = $_FILES['business_doc_files']['error'];
                $_FILES['file']['size'] = $_FILES['business_doc_files']['size'];
      
                $config['upload_path'] = 'assets/Application/Business_Document'; 
                $config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';
                //$config['max_size'] = '5000';
                $config['client_name'] = $business_doc_new;
       
                $this->load->library('upload',$config); 
        
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                }
            }
                    
                $this->session->set_flashdata("success","Application is Inserted Successfully!!!"); 
                redirect($_SERVER['HTTP_REFERER']); 
            }
            else{
                $this->session->set_flashdata("danger","Application is Not Inserted Successfully!!!"); 
                redirect($_SERVER['HTTP_REFERER']); 
            }
    }

    public function delete($id) {

        $select_doc = $this->BusinessDetails_Modal->select_doc($id);
    
        unlink('assets/Application/Business_Document/'.$select_doc[0]->tbl_business_document_document);

        $result = $this->BusinessDetails_Modal->delete($id);

        if ($result == 1) {

            $this->session->set_flashdata("success","Application is Deleted Successfully!!!"); 
            redirect($_SERVER['HTTP_REFERER']);
        }
        else{

            $this->session->set_flashdata("danger","Application is Not Deleted Successfully!!!"); 
            redirect($_SERVER['HTTP_REFERER']);
        }

    } 

    public function saveAnswer()
    {
        $user_id = $this->input->post("user_id");
        $question = $this->input->post("question");
        $answer = $this->input->post("answer");

        $this->db->select("COUNT(id) as count");
        $this->db->where("user_id", $user_id);
        $this->db->where("question_id", $question);
        $query = $this->db->get("tbl_user_question_answer");
        $count = $query->result()[0]->count;

        if ($count == 0) {
            $this->db->insert("tbl_user_question_answer", [
                "question_id" => $question,
                "user_id" => $user_id,
                "answer" => $answer
            ]);
        } else {
            $this->db->where("user_id", $user_id);
            $this->db->where("question_id", $question);
            $this->db->update("tbl_user_question_answer", [
                "question_id" => $question,
                "user_id" => $user_id,
                "answer" => $answer
            ]);
        }

    }

    public function editbbm($id)
    {
        $data['user_id'] = $id;

        $data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

        $data['phases'] = [];

        $this->db->select("*");
        $phases = $this->db->get("tbl_phase")->result();

        $this->db->select("*");
        $sub_phase = $this->db->get("tbl_sub_phase")->result();

        foreach ($phases as $ph) {
            foreach ($sub_phase as $sub_ph) {
                $this->db->select("*");
                $this->db->where("phase_id", $ph->id);
                $this->db->where("sub_phase_id", $sub_ph->id);
                $questions = $this->db->get("tbl_phase_question")->result();

                foreach ($questions as $q) {
                    $this->db->select("answer");
                    $this->db->where("question_id", $q->id);
                    $this->db->where("user_id", $id);
                    $query = $this->db->get("tbl_user_question_answer");
                    $res = $query->result();
                    if (isset($query->result()[0])) {
                        $q->answer = $query->result()[0]->answer;
                    } else {
                        $q->answer = 2;
                    }
                    $ph->sub_phase[$sub_ph->phase][] = $q;
                }
            }
            $data['phases'][] = $ph;
        }

        $this->db->where("tbl_users_id", $id);
        $this->db->update("tbl_users", [
        	"tbl_users_status" => "6"
        ]);

        $this->db->select("*");
        $this->db->where("tbl_users_id", $id);
        $data['user'] = $this->db->get("tbl_users")->result()[0];

        $this->load->view('bdsp/business_details/editbbm', $data);     
    }

    public function handlebbm($id)
    {
        $data['user_id'] = $id;

        $data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

        $this->db->select("*");
        $phases = $this->db->get("tbl_phase")->result();
        $data['phases'] = $phases;

        $this->db->select("*");
        $sub_phase = $this->db->get("tbl_sub_phase")->result();
        $data['subphases'] = $sub_phase;

        $this->db->where("tbl_users_id", $id);
        $this->db->update("tbl_users", [
            "tbl_users_status" => "6"
        ]);

        $this->db->select("*");
        $this->db->where("tbl_users_id", $id);
        $data['user'] = $this->db->get("tbl_users")->result()[0];

        $this->db->select("*");
        $this->db->where("user_id", $id);
        $this->db->where("is_deleted", false);
        $data['questions'] = $this->db->get("tbl_smme_question_answer")->result();

        $this->load->view('bdsp/business_details/handlebbm', $data);     
    }

    public function processQuestions($id) {
        $questionAction = $_POST['questionAction'];
        if($questionAction == "getQuestions") {
            $phaseId = $_POST['phaseId'];
            $subPhaseId = $_POST['subPhaseId'];
            $smmeId = $_POST['smmeId'];

            $this->db->select("*");
            $this->db->where("user_id", $id);
            $this->db->where('phase_id', $phaseId);
            $this->db->where('subphase_id', $subPhaseId);            
            $this->db->where("is_deleted", false);
            $data['questions'] = $this->db->get("tbl_smme_question_answer")->result();
            echo json_encode($data);

        } else if($questionAction == "createQuestion") {
            $phaseId = $_POST['phaseId'];
            $subPhaseId = $_POST['subPhaseId'];
            $smmeId = $_POST['smmeId'];
            $questionText = $_POST['questionText'];
            $this->db->insert("tbl_smme_question_answer", [
                "phase_id" => $phaseId,
                "subphase_id" => $subPhaseId,
                "user_id" => $smmeId,
                "question_text" => $questionText
            ]);
        } else if($questionAction == "editQuestion") {
            $questionId = $_POST['questionId'];
            $questionText = $_POST['questionText'];

            $this->db->where("id", $questionId);
            $this->db->where("user_id", $id);
            $this->db->update("tbl_smme_question_answer", [
                "question_text" => $questionText
            ]);
        } else if($questionAction == "deleteQuestion") {
            $questionId = $_POST['questionId'];
            $this->db->where("id", $questionId);
            $this->db->update("tbl_smme_question_answer", [
                "is_deleted" => true
            ]);
        } else if($questionAction == "partiallyComplete") {
            $questionIds = $_POST['questionIds'];
            $this->db->where_in("id", $questionIds);
            $this->db->update("tbl_smme_question_answer", [
                "is_answered" => true
            ]);
        } else if($questionAction == "completeAll") {
            $phaseId = $_POST['phaseId'];
            $subPhaseId = $_POST['subPhaseId'];
            $smmeId = $_POST['smmeId'];            
            $this->db->where("phase_id", $phaseId);
            $this->db->where("subphase_id", $subPhaseId);
            $this->db->where("user_id", $smmeId);
            $this->db->update("tbl_smme_question_answer", [
                "is_answered" => true
            ]);
        } else {

        }
    }  

    public function bbm()
    {
        $data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

        $this->db->select("tbl_application_smme_id as id");
        $this->db->where("tbl_application_bdsp_id", $this->session->userdata("id_user"));
        $query = $this->db->get('tbl_application');
        $smmeIds = $query->result();

        $this->db->select("smme_id as id");
        $this->db->where("bdsp_id", $this->session->userdata("id_user"));
        $query = $this->db->get('tbl_application_assignment');
        $smmeIds2 = $query->result();

        $all = array_merge($smmeIds, $smmeIds2);

        // to remove duplicates in $all
        $all = array_unique($all, SORT_REGULAR);
        foreach ($all as $smme) {
            $this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name, tbl_users_email as email");
            $this->db->where("tbl_users_id", $smme->id);
            $this->db->where("tbl_users_role_id", "2");
            $query = $this->db->get("tbl_users");
            $data['smmes'][] = $query->row();
        }
        $data['view_data'] = $data['smmes'] ?? [];


        $this->load->view('bdsp/business_details/bbm', $data);
    }
    public function editquestion($id)
    {
        $data['question_id'] = $id;

        $data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

        $this->db->select("*");
        $this->db->where("id", $id);
        $question = $this->db->get("tbl_phase_question")->result()[0];
        $data['question'] = $question;

        $this->load->view('bdsp/business_details/bbmquestionedit', $data);
    }
    public function updateQuestion()
    {
        $question_id = $this->input->post("questionId");
        $question_text = $this->input->post("questionText");
        $this->db->where("id", $question_id);
        $this->db->update("tbl_phase_question", [
            "question" => $question_text
        ]);
    }

}
