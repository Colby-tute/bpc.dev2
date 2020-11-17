<?php defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Africa/Johannesburg');
class BusinessDetails extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("incubator/BusinessDetails_Modal");
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

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        $this->db->select("*");
        $this->db->where("user_id", $this->session->userdata("id_user"));
        $data['partners'] = $this->db->get("tbl_user_partner")->result();

        $this->load->view('incubator/business_details/edit',$data);
    }

    function _get_assigned_smme() {
		$this->db->join('tbl_application','tbl_application.tbl_application_id = tbl_application_assignment.app_id','LEFT');
    	$this->db->select("smme_id as id, app_id, tbl_application.tbl_application_status");
		$this->db->where("incubator_id", $this->session->userdata("id_user"));
		$query = $this->db->get('tbl_application_assignment');
		return $query->result();
    }

	
	 public function uploadDocMsme() {
		$this->db->where('tbl_roles_title', 'MSME');
        $querys=$this->db->get('tbl_roles');
        $results=$querys->result();    


        /*$this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_users_role_id', $results[0]->tbl_roles_id);
        $this->db->group_by('tbl_users_id');
        $query=$this->db->get('tbl_users');
        $result=$query->result();   
		$data['tdata'] = $result; */

		$smmes2 = $this->_get_assigned_smme();



		// $all = array_merge($smmes, $smmes2);
		// to remove duplicates in $all
		$all = array_unique($smmes2, SORT_REGULAR);
		

		foreach ($all as $smme) {
			if($smme->tbl_application_status == "Declined")
			{
			}
			else
			{
				$this->db->select("*");
				$this->db->where("tbl_users_id", $smme->id);
				$query = $this->db->get("tbl_users");
				$user = $query->result();
				//echo '<pre>';print_r($user );
				if(!empty($user)){
					$user[0]->app_id = $smme->app_id;
					$user[0]->tbl_application_status = $smme->tbl_application_status;
					$data['tdata'][] = $user[0];
				}
				
				
			}
		}

		//echo "<pre>"; print_r($data); exit();	
		

		$id = $this->session->userdata('id_user');
		
		$querys = $this->db->query("SELECT tbl_all_documents.tbl_all_documents_title as title, tbl_all_documents.tbl_all_documents_id as docid,tbl_all_documents.tbl_all_documents_document as document, tbl_users.tbl_users_firstname as fname, tbl_users.tbl_users_lastname as lname, tbl_users.tbl_users_user_uniqueid as uniqueid FROM tbl_all_documents,tbl_users WHERE tbl_all_documents.upload_for = tbl_users.tbl_users_id and tbl_all_documents.tbl_all_documents_user_id={$id} and  tbl_all_documents.tbl_all_documents_type='B'");
       
		/*$this->db->where('tbl_all_documents_user_id', $id);
		$this->db->where('upload_for',0);
		$this->db->where('tbl_all_documents_type','B');
        $querys=$this->db->get('tbl_all_documents');*/
        $incu_doc=$querys->result(); 
		$data['incu_doc']=$incu_doc;
		
        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE); 
		$this->load->view('incubator/uploaddoc', $data);		
		 
	 }
	 
	 public function Uplaoddocformsme() {
		 $smmeId = $this->input->post("msmeid");
		  $doctitle = $this->input->post("title");
		  if($doctitle==""){
			  $this->session->set_flashdata("danger","Pls Fill Title"); 
              redirect('incubator/BusinessDetails/uploadDocMsme'.$bdsp);
			}
		 $now = date("Y-m-d H:i:s");
	     $randomid = mt_rand(100000,999999); 
			//echo $randomid;
			
		if($_FILES['upload_msme_doc']['name'] != "")
		{
				$image_replace = str_replace(" ", "_",$_FILES['upload_msme_doc']['name']);
				//$image_replace = str_replace(".", "_", $image_replace);
				$image_name = "business_logo_photo_".$randomid."_".$image_replace;
				
				if(!empty($_FILES['upload_msme_doc']['name'])){
		   
					$_FILES['file']['name'] = $image_name;
					$_FILES['file']['type'] = $_FILES['upload_msme_doc']['type'];
					$_FILES['file']['tmp_name'] = $_FILES['upload_msme_doc']['tmp_name'];
					$_FILES['file']['error'] = $_FILES['upload_msme_doc']['error'];
					$_FILES['file']['size'] = $_FILES['upload_msme_doc']['size'];
		  
					$config['upload_path'] = 'assets/users'; 
					$config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|pdf';
					//$config['max_size'] = '5000';
					$config['client_name'] = $image_name;
		   
					$this->load->library('upload',$config); 
			
					if($this->upload->do_upload('file')){
						$uploadData = $this->upload->data();
					}
				}
				
				$newdata = array(	
				    'tbl_all_documents_user_id' =>$this->session->userdata("id_user"),
					'tbl_all_documents_title'=>$doctitle,
					'tbl_all_documents_document' => $image_name,
					'tbl_all_documents_insertdate'=>$now,
					'upload_for' => $smmeId,
					'tbl_all_documents_type'=>'B'
					); 
								//print_r($businessId);exit;
					$this->db->insert('tbl_all_documents', $newdata);
					$this->session->set_flashdata("success","Upload Document Successfully"); 
                    redirect('incubator/BusinessDetails/uploadDocMsme');
		}
		
		
	 }

    public function viewFunds($smmeId) {

        $this->db->select("*");
        $this->db->where("tbl_business_details_user_id", $smmeId);
        $query=$this->db->get('tbl_business_details');
        $result=$query->result();
        $data['funds'] = $result;
        $data['smme_id'] = $smmeId;

        $this->db->select("tbl_users_firstname as firstname, tbl_users_lastname as lastname");
        $this->db->where("tbl_users_id", $smmeId);
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        $data['smme'] = $result;

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        $this->load->view('incubator/business_details/viewFunds',$data);
    }

    public function submitEditFunds() {
        $smmeId = $this->input->post("smme_id");
        $businessId = $this->input->post("tbl_business_details_id");

        if(!empty($businessId)){
	        $this->db->where("tbl_business_details_id", $businessId);
	        $result = $this->db->update("tbl_business_details", array(
	            "tbl_business_details_revenue_raised" => $this->input->post("tbl_business_details_revenue_raised"),
	        ));
    	} else {
    		$result = $this->db->insert("tbl_business_details", array(
	            "tbl_business_details_revenue_raised" => $this->input->post("tbl_business_details_revenue_raised"),
	            "tbl_business_details_user_id" => $smmeId
	        ));
    	}
        redirect("incubator/BusinessDetails/viewFunds/" . $smmeId, 'location');
    }

    public function get_sub_industries() {

        $ind_id = $this->input->post('ind_id');

        $sub_industries = $this->BusinessDetails_Modal->sub_industries($ind_id);

        echo json_encode($sub_industries);
    }

    public function add_partner($user_id)
    {
        $this->db->insert("tbl_user_partner", $_POST);

        redirect("incubator/BusinessDetails");
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
        redirect("incubator/BusinessDetails");
    }

    public function update($upd_id) {

		if($_POST)
		{
			//print_r($_POST);exit;
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
						return redirect(site_url('incubator/BusinessDetails'));
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

					 'tbl_business_details_investmant_need'=> $this->input->post('tbl_business_details_investmant_need'),

					 'tbl_business_details_areyouteam'=> $this->input->post('tbl_business_details_areyouteam'),
					 
					 'tbl_business_details_business_logo'=> $image_name,
				); 

			$smme_teams = array(

				 'tbl_smme_teams_first_name' => $this->input->post('tbl_smme_teams_first_name'),

				 'tbl_smme_teams_last_name' => $this->input->post('tbl_smme_teams_last_name'),

				 'tbl_smme_teams_email' => $this->input->post('tbl_smme_teams_email'),

				 'tbl_smme_teams_mobile'=> $this->input->post('tbl_smme_teams_mobile'),

				 'tbl_smme_teams_insertdate'=> $now,

			); 
			$result = $this->BusinessDetails_Modal->update_master($business,$smme_teams,$upd_id,$this->input->post('tbl_business_details_id'));
			if($result == 1) {
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
					$this->session->set_flashdata('success', 'Data inserted successfully!');
					redirect($_SERVER['HTTP_REFERER']);
				}
			if($result == 2) {
				$this->session->set_flashdata('danger', 'Username or Email id is Duplicate!');
				redirect($_SERVER['HTTP_REFERER']);
			}
			elseif($result == 0) {
				$this->session->set_flashdata('danger', 'Failed! Please make changes to update.');
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
                    
                $this->session->set_flashdata("success","Document uploaded successfully!!!"); 
                redirect($_SERVER['HTTP_REFERER']); 
            }
            else{
                $this->session->set_flashdata("danger","An error has occured while uploading the document!!!"); 
                redirect($_SERVER['HTTP_REFERER']); 
            }
    }

    public function delete($id) {

        $select_doc = $this->BusinessDetails_Modal->select_doc($id);
    
        unlink('assets/Application/Business_Document/'.$select_doc[0]->tbl_business_document_document);

        $result = $this->BusinessDetails_Modal->delete($id);

        if ($result == 1) {

            $this->session->set_flashdata("success","Document has been deleted successfully!!!"); 
            redirect($_SERVER['HTTP_REFERER']);
        }
        else{

            $this->session->set_flashdata("danger","An error has occured while deleting the document!!!"); 
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

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        $data['phases'] = [];

        $this->db->select("*");
        $phases = $this->db->get("tbl_phase")->result();
        $phases[] = (object)[
            'id' => 123123,
            'phase' => 'Additional Questions'
        ];

        $this->db->select("*");
        $sub_phase = $this->db->get("tbl_sub_phase")->result();

        foreach ($phases as $key => $ph) {
            foreach ($sub_phase as $sub_ph) {
                if ($key+1 == count($phases)) {
                    $this->db->select("*");
                    $this->db->where("user_id", $id);
                    //TODO FIX
                    // $questions = $this->db->get("addon_question")->result();
                } else {
                    $this->db->select("*");
                    $this->db->where("phase_id", $ph->id);
                    $this->db->where("sub_phase_id", $sub_ph->id);
                    $questions = $this->db->get("tbl_phase_question")->result();
                }

                if ($questions) {
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

        $this->load->view('incubator/business_details/editbbm', $data);     
    }

    public function handlebbm($id)
    {
        $data['user_id'] = $id;

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

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

        $this->load->view('incubator/business_details/handlebbm', $data);     
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
	
	function bbmprogress($smmeid) {

        $this->db->select("*");
        $phases = $this->db->get("tbl_phase")->result_array();

        $phasePercentage = 0;
        foreach ($phases as $phase) {
	        //answered count
	       	$this->db->select("phase_id,COUNT(id) as answered_count");
	        $this->db->where("user_id", $smmeid);
	        $this->db->where("is_answered", true);
	        $this->db->where("is_deleted", false);
	        $this->db->where('phase_id', $phase['id']);
	        $this->db->group_by('phase_id');
	        $answered = $this->db->get("tbl_smme_question_answer")->result();
	        //total questions
	       	$this->db->select("phase_id,COUNT(id) as total_count");
	        $this->db->where("user_id", $smmeid);
	        $this->db->where("is_deleted", false);
	        $this->db->where('phase_id', $phase['id']);
	        $this->db->group_by('phase_id');
	        $questions = $this->db->get("tbl_smme_question_answer")->result();
	        if(sizeof($answered) > 0 && sizeof($questions) > 0) {
	        	$phasePercentage += (($answered[0]->answered_count / $questions[0]->total_count)*100);
	        }

        }//end of phase foreach	
        return $phasePercentage/sizeof($phases);
	}
	

    public function bbm()
    {
        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);
        $this->db->join('tbl_application','tbl_application.tbl_application_id = tbl_application_assignment.app_id','LEFT');
    	$this->db->select("smme_id as id, app_id, tbl_application.tbl_application_status");
		$this->db->where("incubator_id", $this->session->userdata("id_user"));
		$smmes2query = $this->db->get('tbl_application_assignment');

		$all = array_unique($smmes2query->result(), SORT_REGULAR);
		$dataUser = [];
		foreach ($all as $smme) {
			if($smme->tbl_application_status == "Declined")
			{
			}
			else
			{
				$this->db->select("tbl_users_id as id, tbl_users_user_uniqueid as uniqueid,tbl_users_mobile as mobile, tbl_users_firstname as name, tbl_users_lastname as last_name, tbl_users_email as email");
        		$this->db->where("tbl_users_role_id", "2");
				$this->db->where("tbl_users_id", $smme->id);
				$query = $this->db->get("tbl_users");
				$user = $query->result();
				//echo '<pre>';print_r($user );
				if(!empty($user)){
					$dataUser[] = (object)$user[0];
				}
				
				
			}
		}


        // $this->db->select("tbl_users_id as id, tbl_users_user_uniqueid as uniqueid,tbl_users_mobile as mobile, tbl_users_firstname as name, tbl_users_lastname as last_name, tbl_users_email as email");
        // $this->db->where("tbl_users_role_id", "2");

        $data['view_data'] = $dataUser ?? [];
		$result3=[];
		foreach($data['view_data'] as $row){			
			$user_id=$row->id;
			$bbmpro=$this->bbmprogress($user_id);
			$result3[]=(object)["bbmprog" => $bbmpro];;
		}
        $data['bbmprodetails'] = $result3 ?? [];
		//print_r($data['bbm']);exit;
        $this->load->view('incubator/business_details/bbm', $data);
    }

    public function add_question($user_id)
    {
        $data['user_id'] = $user_id;

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $this->db->insert("addon_questions", $_POST);
            redirect(site_url("incubator/business_details/bbm"), 'refresh');
        }

        $this->load->view("incubator/business_details/add_question", $data);

    }

}
