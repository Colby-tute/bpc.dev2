<?php defined('BASEPATH') or exit('No direct script access allowed');


date_default_timezone_set('Africa/Johannesburg');

class Application extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('Login');
        }	

		$this->load->model("bdsp/Application_Modal");

		$this->load->database();

		$this->load->helper('email_service');

	}


	public function index()
	{

		//echo "string";exit();

		$result = $this->Application_Modal->View_Application();

		$data['view_data'] = $result;



		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);


		$this->load->view('bdsp/application/index', $data);

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

		$this->load->view('bdsp/application/editbbm', $data);		
	}

	public function bbm()
	{
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name, tbl_users_email as email");
		$this->db->where("tbl_users_role_id", "2");
		$data['view_data'] = $this->db->get("tbl_users")->result();

		$this->load->view('bdsp/application/bbm', $data);
	}

	public function add()
	{


		if ($_POST) {

			//print_r($_POST);exit();

			$now = date("Y-m-d H:i:s");

			//print_r($_POST);
			$select_smme_per = $this->Application_Modal->select_user_data($_POST['smme_id']);

			// $business_doc = str_replace(" ", "_", $_FILES['business_doc']['name']);

			// $business_doc_new = "business_document_" . $select_smme_per[0]->tbl_users_id . "_" . $business_doc;


			$motivation_letter = str_replace(" ", "_", $_FILES['motivation_letter']['name']);

			$motivation_letter_new = "motivation_letter_" . $select_smme_per[0]->tbl_users_id . "_" . $motivation_letter;


			//print_r($motivation_letter_new);


			$data = array(


				'tbl_application_bdsp_id' => $this->input->post('bdsp_id'),


				'tbl_application_bdsp_id' => $this->input->post('bdsp_id'),


				'tbl_application_smme_id' => $_POST['smme_id'],


				// 'tbl_application_business_doc' => $business_doc_new,


				// 'tbl_application_motivation_text' => $this->input->post('motivation_text'),


				'tbl_application_motivation_letter' => $motivation_letter_new,


				// 'tbl_application_status' => 'Applied',


				'tbl_application_insertdate' => $now,

			);

			//exit;

			$result = $this->Application_Modal->Insert_Application($data);


			if ($result == 1) {


				// if (!empty($_FILES['business_doc']['name'])) {


				// 	$_FILES['file']['name'] = $business_doc_new;

				// 	// $_FILES['file']['type'] = $_FILES['business_doc']['type'];

				// 	$_FILES['file']['tmp_name'] = $_FILES['business_doc']['tmp_name'];

				// 	$_FILES['file']['error'] = $_FILES['business_doc']['error'];

				// 	$_FILES['file']['size'] = $_FILES['business_doc']['size'];


				// 	$config['upload_path'] = 'assets/Application/Business_Document';

				// 	$config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';

				// 	//$config['max_size'] = '5000';

				// 	$config['file_name'] = $business_doc_new;


				// 	$this->load->library('upload', $config);


				// 	if ($this->upload->do_upload('file')) {

				// 		$uploadData = $this->upload->data();

				// 		/*$filename = $uploadData['client_name'];

				// 		$data1['totalFiles'][] = $filename;*/

				// 	}

				// }


				if (!empty($_FILES['motivation_letter']['name'])) {


					$_FILES['file']['name'] = $motivation_letter_new;

					$_FILES['file']['type'] = $_FILES['motivation_letter']['type'];

					$_FILES['file']['tmp_name'] = $_FILES['motivation_letter']['tmp_name'];

					$_FILES['file']['error'] = $_FILES['motivation_letter']['error'];

					$_FILES['file']['size'] = $_FILES['motivation_letter']['size'];


					$config1['upload_path'] = 'assets/Application/Motivation_Letter';

					$config1['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';

					//$config['max_size'] = '5000';

					$config1['file_name'] = $motivation_letter_new;


					$this->load->library('upload', $config1);

					//$this->upload->initialize($config1);

					if ($this->upload->do_upload('file')) {

						$uploadData = $this->upload->data();

						/* $filename = $uploadData['client_name'];

						 $data2['totalFiles'][] = $filename;*/

					}

				}

				$this->session->set_flashdata("success", "Application is Inserted Successfully!!!");

				redirect('bdsp/application');

			} else {

				$this->session->set_flashdata("danger", "Application is Not Inserted Successfully!!!");

				redirect('bdsp/application');

			}

		}


		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);


		$select_bdsp = $this->Application_Modal->select_bdsp();

		$data['select_bdsp'] = $select_bdsp;


		$select_bdsp = $this->Application_Modal->select_bdsp();

		$data['select_bdsp'] = $select_bdsp;


		$select_smme = $this->Application_Modal->select_smme();

		$data['select_smme'] = $select_smme;


		$this->load->view('bdsp/application/add', $data);

	}


	public function edit($id)
	{


		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);


		$result = $this->Application_Modal->Edit_Application($id);

		$data['edit_data'] = $result;


		$select_bdsp = $this->Application_Modal->select_bdsp();

		$data['select_bdsp'] = $select_bdsp;


		$select_bdsp = $this->Application_Modal->select_bdsp();

		$data['select_bdsp'] = $select_bdsp;


		$select_smme = $this->Application_Modal->select_smme();

		$data['select_smme'] = $select_smme;


		$this->load->view('bdsp/application/edit', $data);


	}


	public function update($id)
	{


		/*print_r($_POST);

		print_r($_FILES);*/


		if ($_FILES['business_doc']['name'] == '') {


			$business_doc_new = $this->input->post('old_business_doc');

		} else {


			$business_doc = str_replace(" ", "_", $_FILES['business_doc']['name']);

			$business_doc_new = "business_document_" . $this->session->userdata('user_unique_id') . "_" . $business_doc;

		}


		if ($_FILES['motivation_letter']['name'] == '') {


			$motivation_letter_new = $this->input->post('old_motivation_letter');

		} else {

			$select_smme_per = $this->Application_Modal->select_smme_per($this->session->post('smme_id'));

			$business_doc = str_replace(" ", "_", $_FILES['business_doc']['name']);

			$business_doc_new = "business_document_" . $select_smme_per[0]->tbl_users_id . "_" . $business_doc;


			$motivation_letter = str_replace(" ", "_", $_FILES['motivation_letter']['name']);

			$motivation_letter_new = "motivation_letter_" . $select_smme_per[0]->tbl_users_id . "_" . $motivation_letter;


		}


		//print_r($motivation_letter_new);

		$data = array(


			'tbl_application_bdsp_id' => $this->input->post('bdsp_id'),


			'tbl_application_bdsp_id' => $this->input->post('bdsp_id'),


			'tbl_application_business_doc' => $business_doc_new,


			'tbl_application_motivation_text' => $this->input->post('motivation_text'),


			'tbl_application_motivation_letter' => $motivation_letter_new,

		);


		$result = $this->Application_Modal->Update_Application($data, $id);


		if ($result == 1) {

			//to insert questions for each smme when application is updated
			$smme_id = $this->session->post('smme_id');
	        $this->db->where("user_id", $smme_id);
	        $count = $this->db->get("tbl_smme_question_answer")->num_rows();
	        if ($count == 0) {
	            $query = $this->db->get('tbl_phase_question');
	            foreach ($query->result() as $row) {
	                  $rowdata = array (
	                    'user_id' => $smme_id,
	                    'phase_id' => $row->phase_id,
	                    'subphase_id' => $row->sub_phase_id,
	                    'question_text' => $row->question,
	                    'is_answered' => 0,
	                    'is_deleted' => 0,
	                    'target_date' => date('Y-m-d', strtotime(date('Y-m-d') . "+30 days"))
	                  );
	                  $this->db->insert('tbl_smme_question_answer',$rowdata);
	            }
	        }
			if (!empty($_FILES['business_doc']['name'])) {


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


				$this->load->library('upload', $config);


				if ($this->upload->do_upload('file')) {

					$uploadData = $this->upload->data();

				}

			}


			if (!empty($_FILES['motivation_letter']['name'])) {


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


				$this->load->library('upload', $config1);

				//$this->upload->initialize($config1);

				if ($this->upload->do_upload('file')) {

					$uploadData = $this->upload->data();

				}

			}

			$this->session->set_flashdata("success", "Application is Updated Successfully!!!");

			redirect('bdsp/application');

		} else {


			$this->session->set_flashdata("danger", "Application is Not Updated Successfully!!!");

			redirect('bdsp/application');

		}

	}


	public function delete($id)
	{


		$result = $this->Application_Modal->Delete_Application($id);


		if ($result == 1) {


			$this->session->set_flashdata("success", "Application is Deleted Successfully!!!");

			redirect('bdsp/application');

		} else {


			$this->session->set_flashdata("danger", "Application is Not Deleted Successfully!!!");

			redirect('bdsp/application');

		}

	}

	public function stats_change()
	{
		$now = date("Y-m-d H:i:s");
		
		if ($this->input->post('status') == "Approved") {
			$tbl_application_status = "Approved";
		}
		else
		{
			$tbl_application_status = "Declined";
		}
		$data = array(
			'tbl_application_status' => $tbl_application_status,
			'tbl_application_admin_approve_date' => $now,
		);

		$result = $this->Application_Modal->stats_change($this->input->post('id'), $data);
		$user = $this->db->where('tbl_users_id',$this->input->post("user_id"))->get('tbl_users')->row();

		$owner = $this->db->where('	tbl_users_id',$this->session->userdata('user_id'))->get('tbl_users')->row();
		$process_key = "application_status";
		$emailData = $this->db->where('process_key',$process_key)->get('tbl_emails')->row();
		$data['title'] = $emailData->subject;
        $keys = [
        		'[name_to]' => $user->tbl_users_firstname .' ' . $user->tbl_users_lastname,
        		'[name_from]' => $owner->tbl_users_firstname .' ' . $owner->tbl_users_lastname,
        	];
       	$content = do_shortcodes($emailData->message,$keys);
        email_send($user->tbl_users_email,$emailData->subject,$emailData->subject,$content);
		if ($this->input->post('status') == "Approved") {
			$now = date("Y-m-d H:i:s");
			$update = ['tbl_users_status' => "4"];
		} else {
			$update = ['tbl_users_status' => "9"];
		}

		if ($this->input->post('status') == "Approved") {
			$smme_id = $this->input->post("user_id");
			$application_id = $this->input->post("id");

			$this->db->select("*");
	        $this->db->where("smme_id", $smme_id);
	        $this->db->where("app_id", $application_id);
	        $this->db->where('bdsp_id IS NOT NULL', null, false);
	        $result = $this->db->get("tbl_application_assignment")->result();
	        $bdsp_id = $result[0]->bdsp_id;

			$this->db->select("incubation_id");
	        $this->db->where_in("user_id", [$smme_id, $bdsp_id]);
	        $result = $this->db->get("tbl_incubation_users")->result();

	        $inc_users_count = sizeof($result);
	        if($inc_users_count == 2) {
	        	if($result[0]->incubation_id != $result[1]->incubation_id) {
	        		$incdata = NULL;
	        		foreach ($result as $user) {
	        			if($user->user_id == $bdsp_id){
			        		$incdata = array(
			        			'incubation_id' => $user->incubation_id
			        		);	        				
	        			}
	        		}
					$this->db->where("user_id", $smme_id);
					$this->db->update("tbl_incubation_users", $incdata);
	        	}
	        } else if ($inc_users_count == 1 && $result[0]->incubation_id == $bdsp_id) {
        		$incdata = array(
                    'user_id' => $smme_id,
                    'incubation_id' => $result[0]->incubation_id
        		);
        		$this->db->insert('tbl_incubation_users',$incdata);	        	
	        }
		}

		$this->db->where("tbl_users_id", $this->input->post("user_id"));
		$this->db->update("tbl_users", $update);

		$this->db->select("tbl_application_smme_id as id, tbl_application_admin_approve_date");
		$this->db->where("tbl_application_id", $this->input->post("id"));
		$app = $this->db->get("tbl_application")->result()[0];
		echo json_encode($app);

		//echo "Application is " . $this->input->post('status') . "";

		// redirect('bdsp/application');

		//to insert questions for each smme when application is approved
		if ($app->tbl_application_admin_approve_date) {
			$smme_id = $this->input->post("user_id");
	        $this->db->where("user_id", $smme_id);
	        $count = $this->db->get("tbl_smme_question_answer")->num_rows();
	        if ($count == 0) {
	            $query = $this->db->get('tbl_phase_question');
	            foreach ($query->result() as $row) {
	                  $rowdata = array (
	                    'user_id' => $smme_id,
	                    'phase_id' => $row->phase_id,
	                    'subphase_id' => $row->sub_phase_id,
	                    'question_text' => $row->question,
	                    'is_answered' => 0,
	                    'is_deleted' => 0,
	                    'target_date' => date('Y-m-d', strtotime(date('Y-m-d') . "+30 days"))
	                  );
	                  $this->db->insert('tbl_smme_question_answer',$rowdata);
	            }
	        }
    	}

	}

	public function update_inc_coaches() {
		$app_id     = $_POST['app_id'];
		$smme_id    = $_POST['smme_id'];
		$newCoaches = $_POST['newCoaches'];
		$newInc     = explode('  ', $_POST['newInc']);
		// print_r($_POST);exit();
		$this->update_bdsp_coaches($app_id, $smme_id, $newCoaches, $newInc);
	}

	public function update_bdsp_coaches($app_id, $id, $newCoaches, $newInc) {
		$this->db->select("bdsp_id as id");
			$this->db->where("app_id", $app_id);
			$this->db->where("bdsp_id IS NOT NULL");
			$query = $this->db->get("tbl_application_assignment");
			$selectedBdsps = $query->result();

			$oldCoaches = [];
			if ($selectedBdsps) {
				foreach ($selectedBdsps  as $bdsp) {
					$oldCoaches[] = $bdsp->id;
				}
			}

			$this->db->select("bdsp_id as id");
			$this->db->where("app_id", $app_id);
			$this->db->where("bdsp_id IS NOT NULL");
			$query = $this->db->get("tbl_application_assignment");
			$selectedIncs = $query->result();

			$oldIncs = [];
			if ($selectedIncs) {
				foreach ($selectedIncs  as $inc) {
					$oldIncs[] = $inc->id;
				}
			}

			$forDeleteCh = array_diff($oldCoaches, $newCoaches);
			$forSaveCh = array_diff($newCoaches, $oldCoaches);

			if ($forDeleteCh) {
				foreach ($forDeleteCh as $ch_id) {
					$this->db->where("app_id", $app_id);
					$this->db->where("bdsp_id", $ch_id);
					$this->db->delete("tbl_application_assignment");
				}
			}

			if ($forSaveCh) {
				foreach ($forSaveCh as $ch_id) {
					$this->db->insert("tbl_application_assignment", [
						"app_id" => $app_id,
						"smme_id" => $id,
						"bdsp_id" => $ch_id
					]);
				}
			}

			$forDeleteInc = array_diff($oldIncs, $newInc);
			$forSaveInc = array_diff($newInc, $oldIncs);

			if ($forDeleteInc) {
				foreach ($forDeleteInc as $ch_id) {
					$this->db->where("app_id", $app_id);
					$this->db->where("bdsp_id", $ch_id);
					$this->db->delete("tbl_application_assignment");
				}
			}

			if ($forSaveInc) {
				foreach ($forSaveInc as $ch_id) {
					$this->db->insert("tbl_application_assignment", [
						"app_id" => $app_id,
						"smme_id" => $id,
						"bdsp_id" => $ch_id
					]);
				}
			}
			$this->session->set_flashdata("success", "bdsp, coaches updated successfully!");
		}
	

	public function view($app_id, $id)
	{

		//echo $app_id.'-'.$id;exit;

		$data['user_id'] = $id;
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$newCoaches = $this->input->post('coaches') ? $this->input->post('coaches') : [];
			$newInc =  $this->input->post('bdsps') ? $this->input->post('bdsps') : [];
			$this->update_bdsp_coaches($app_id, $id, $newCoaches, $newInc);

			if(sizeof($newInc) == 1) {
				$smme_id = $id;
				$application_id = $app_id;

				$this->db->select("bdsp_id");
		        $this->db->where("smme_id", $smme_id);
		        $this->db->where("app_id", $application_id);
		        $this->db->where('bdsp_id IS NOT NULL', null, false);
		        $result = $this->db->get("tbl_application_assignment")->result();
		        $bdsp_id = $result[0]->bdsp_id;

				$this->db->select("*");
		        $this->db->where_in("user_id", [$smme_id, $bdsp_id]);
		        $result = $this->db->get("tbl_incubation_users")->result();

		        $inc_users_count = sizeof($result);
		        if($inc_users_count == 2) {
		        	if($result[0]->incubation_id != $result[1]->incubation_id) {
		        		$incdata = NULL;
		        		foreach ($result as $user) {
		        			if($user->user_id == $bdsp_id){
				        		$incdata = array(
				        			'incubation_id' => $user->incubation_id
				        		);	        				
		        			}
		        		}
						$this->db->where("user_id", $smme_id);
						$this->db->update("tbl_incubation_users", $incdata);
		        	}
		        } else if ($inc_users_count == 1 && $result[0]->user_id == $bdsp_id) {
	        		$incdata = array(
	                    'user_id' => $smme_id,
	                    'incubation_id' => $result[0]->incubation_id
	        		);
	        		$this->db->insert('tbl_incubation_users',$incdata);	        	
		        } 

		        //TODO: Incubator not present in tbl_incubation_users is not handled.
	    	}


			// $this->db->select("bdsp_id as id");
			// $this->db->where("app_id", $app_id);
			// $this->db->where("bdsp_id IS NOT NULL");
			// $query = $this->db->get("tbl_application_assignment");
			// $selectedBdsps = $query->result();

			// $oldCoaches = [];
			// if ($selectedBdsps) {
			// 	foreach ($selectedBdsps  as $bdsp) {
			// 		$oldCoaches[] = $bdsp->id;
			// 	}
			// }

			// $this->db->select("bdsp_id as id");
			// $this->db->where("app_id", $app_id);
			// $this->db->where("bdsp_id IS NOT NULL");
			// $query = $this->db->get("tbl_application_assignment");
			// $selectedIncs = $query->result();

			// $oldIncs = [];
			// if ($selectedIncs) {
			// 	foreach ($selectedIncs  as $inc) {
			// 		$oldIncs[] = $inc->id;
			// 	}
			// }

			// $forDeleteCh = array_diff($oldCoaches, $newCoaches);
			// $forSaveCh = array_diff($newCoaches, $oldCoaches);

			// if ($forDeleteCh) {
			// 	foreach ($forDeleteCh as $ch_id) {
			// 		$this->db->where("app_id", $app_id);
			// 		$this->db->where("bdsp_id", $ch_id);
			// 		$this->db->delete("tbl_application_assignment");
			// 	}
			// }

			// if ($forSaveCh) {
			// 	foreach ($forSaveCh as $ch_id) {
			// 		$this->db->insert("tbl_application_assignment", [
			// 			"app_id" => $app_id,
			// 			"smme_id" => $id,
			// 			"bdsp_id" => $ch_id
			// 		]);
			// 	}
			// }

			// $forDeleteInc = array_diff($oldIncs, $newInc);
			// $forSaveInc = array_diff($newInc, $oldIncs);

			// if ($forDeleteInc) {
			// 	foreach ($forDeleteInc as $ch_id) {
			// 		$this->db->where("app_id", $app_id);
			// 		$this->db->where("bdsp_id", $ch_id);
			// 		$this->db->delete("tbl_application_assignment");
			// 	}
			// }

			// if ($forSaveInc) {
			// 	foreach ($forSaveInc as $ch_id) {
			// 		$this->db->insert("tbl_application_assignment", [
			// 			"app_id" => $app_id,
			// 			"smme_id" => $id,
			// 			"bdsp_id" => $ch_id
			// 		]);
			// 	}
			// }

		}

		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

		$personal = $this->Application_Modal->select_user_personal_data($id);

		$data['personal'] = $personal;

		$userdt = $this->Application_Modal->select_user_data($id);

		$data['userdt'] = $userdt;

		$business = $this->Application_Modal->select_user_business_data($id);
		$data['business'] = $business;

		$smme_teams = $this->Application_Modal->select_smme_teams_data($id);
		$data['smme_teams'] = $smme_teams;

		$result = $this->Application_Modal->Edit_Application($app_id);
		$data['edit_data'] = $result;

		$select_mul_doc = $this->Application_Modal->select_mul_doc_id($app_id);
		$data['select_mul_doc'] = $select_mul_doc;

		$bdsp_incubator_smme_name = $this->Application_Modal->bdsp_incubator_smme_name($app_id);
		$data['bdsp_incubator_smme_name'] = $bdsp_incubator_smme_name;

		$data['app_id'] = $app_id;
		$data['id'] = $id;

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_role_id", 3);
		$query = $this->db->get("tbl_users");
		$data['incubators'] = $query->result();
		
		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_role_id", 4);
		$query = $this->db->get("tbl_users");
		$data['bdsps'] = $query->result();

		$this->db->select("bdsp_id as id");
		$this->db->where("app_id", $app_id);
		$this->db->where("bdsp_id IS NOT NULL");
		$query = $this->db->get("tbl_application_assignment");
		$selectedBdsps = $query->result();

		$data['selectedBdsps'] = [];
		if ($selectedBdsps) {
			foreach ($selectedBdsps as $selectedBdsp) {
				$data['selectedBdsps'][] = $selectedBdsp->id;
			}
		}

		$this->db->select("bdsp_id as id");
		$this->db->where("app_id", $app_id);
		$this->db->where("bdsp_id IS NOT NULL");
		$query = $this->db->get("tbl_application_assignment");
		$selectedIncubators = $query->result();

		$data['selectedIncubators'] = [];
		if ($selectedIncubators) {
			foreach ($selectedIncubators as $selectedIncubator) {
				$data['selectedIncubators'][] = $selectedIncubator->id;
			}
		}

		$this->load->view('bdsp/application/view', $data);
	}

}

