<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Smme extends MY_Controller

{


	function __construct()
	{

		parent::__construct();
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
		$this->load->model("admin/Smme_User_model");

		$this->load->model("admin/Board");

		$this->load->database();

	}

	public function directory()
	{
		$key = $this->input->get('key');
		$this->db->select("*");

		$result = $this->Smme_User_model->msme_directory_get_all($key);

		$data['tdata'] = $result;

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view('admin/smme/directory', $data);

		}
	public function editMilestone($id)
	{
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$data['id'] = $id;

		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get("tbl_milestone");
		$data['milestone'] = $query->result();

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$sql = "UPDATE tbl_milestone SET title=?, description=?, end_date=? WHERE id=?";
			$this->db->query($sql, array($this->input->post('title'), $this->input->post('description'), $this->input->post('end_date'), $id));

			$newTasks = $this->input->post("tasks");
			$this->db->select("task_id");
			$this->db->where("milestone_id", $id);
			$query = $this->db->get("tbl_milestone_tasks");
			$oldTasks = $query->result();
			$oldIds = [];
			foreach ($oldTasks as $id) {
				$oldIds[] = $id->task_id;
			}

			$forDelete = array_diff($oldIds, $newTasks);
			$forSave = array_diff($newTasks, $oldIds);

			if ($forDelete) {
				foreach ($forDelete as $id) {
					$this->db->where("task_id", $id);
					$this->db->where("milestone_id", $data['milestone'][0]->id);
					$this->db->delete('tbl_milestone_tasks');
				}
			}

			if ($forSave) {
				foreach ($forSave as $id) {
					$this->db->insert("tbl_milestone_tasks", [
						"task_id" => $id,
						"milestone_id" => $data['milestone'][0]->id
					]);
				}
			}

			redirect(site_url("/incubator/Smme/createMilestone/".$data['milestone'][0]->smme_id."/true"), 'refresh');
		}

		$this->db->select('tbl_board_id as id');
		$this->db->where('tbl_board_smme_unique_id', $data['milestone'][0]->smme_id);
		$query = $this->db->get("tbl_board");
		$board = $query->result();

		$boards = [];
		foreach ($board as $b) {
			$boards[] = $b->id;
		}

		$this->db->select('task_id');
		$this->db->where('milestone_id', $id);
		$query = $this->db->get("tbl_milestone_tasks");
		$tsk = $query->result();

		$this->db->select('tbl_boardlist_id as id, tbl_boardlist_title as title');
		$this->db->where('tbl_boardlist_board_id IN ('.implode(",", $boards).')');
		$query = $this->db->get("tbl_boardlist");
		$data['tasks'] = $query->result();

		$data['selectedTasks'] = [];

		foreach ($tsk as $t) {
			$this->db->select('*');
			$this->db->where('tbl_boardlist_id', $t->task_id);
			$query = $this->db->get("tbl_boardlist");
			$task = $query->result();

			foreach ( $task as $ts ) {
				$data['selectedTasks'][] = $ts->tbl_boardlist_id;
			}
		}

		$this->load->view('incubator/smme/edit-milestone', $data);
	}

	public function viewEvaluate($id)
	{
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->db->select("*");
		$this->db->where("id", $id);
		$evaluation = $this->db->get("tbl_evaluate")->result()[0];

		$this->db->select("tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_id", $evaluation->user_id);
		$bdsp = $this->db->get("tbl_users")->result();
		$evaluation->bdsp = $bdsp[0]->name . " " . $bdsp[0]->last_name;

		$this->db->select("tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_id", $evaluation->smme_id);
		$smme = $this->db->get("tbl_users")->result();
		$evaluation->smme = $smme[0]->name . " " . $smme[0]->last_name;

		$data['evaluation'] = $evaluation;

		$this->load->view('incubator/smme/viewEvaluate', $data);
	}

	public function viewEvBdsp($id)
	{
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->db->select("*");
		$this->db->where("id", $id);
		$evaluation = $this->db->get("tbl_evaluate_bdsp_inc")->result()[0];

		$this->db->select("tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_id", $evaluation->bdsp_id);
		$bdsp = $this->db->get("tbl_users")->result();
		$evaluation->bdsp = $bdsp[0]->name . " " . $bdsp[0]->last_name;

		$data['evaluation'] = $evaluation;

		$this->load->view('incubator/smme/viewEvBdsp', $data);
	}


	public function deleteMilestone($id, $smme_id)
	{
		$this->db->where("id", $id);
		$this->db->delete("tbl_milestone");
		return $this->createMilestone($smme_id);
	}

	public function createMilestone($i, $flag = false)
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST' && !$flag) {
			$this->db->insert("tbl_milestone", [
				"title" => htmlentities($_POST['title']),
				"description" => htmlentities($_POST['description']),
				"end_date" => htmlentities($_POST['end_date']),
				"smme_id" => $i
			]);
			$id = $this->db->insert_id();
			if (isset($_POST['tasks']) && $_POST['tasks']) {
				foreach ($_POST['tasks'] as $task) {
					$this->db->insert("tbl_milestone_tasks", [
						"milestone_id" => $id,
						"task_id" => $task
					]);
				}
			}
		}

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->db->select('tbl_board_id as id');
		$this->db->where('tbl_board_smme_unique_id', $i);
		$query = $this->db->get("tbl_board");
		$board = $query->result();

		$boards = [0];
		foreach ($board as $b) {
			$boards[] = $b->id;
		}

		$this->db->select('tbl_boardlist_id as id, tbl_boardlist_title as title');
		$this->db->where('tbl_boardlist_board_id IN ('.implode(",", $boards).')');
		$query = $this->db->get("tbl_boardlist");
		$data['tasks'] = $query->result();
		$data['smmeId'] = $i;

		$this->db->select('id, title, end_date, description');
		$this->db->where('smme_id='.$i);
		$query = $this->db->get("tbl_milestone");
		$milestones = $query->result();

		$data['milestones'] = [];

		foreach ($milestones as $k => $ms) {
			$this->db->select('task_id as id');
			$this->db->where('milestone_id='.$ms->id);
			$query = $this->db->get("tbl_milestone_tasks");
			$tasks = $query->result();

			$data['milestones'][$k]['milestone'] = $ms;

			foreach ($tasks as $id) {
				$this->db->select('tbl_boardlist_title as title, tbl_boardlist_id as id');
				$this->db->where('tbl_boardlist_id='.$id->id);
				$query = $this->db->get("tbl_boardlist");
				$task = $query->result();

				$data['milestones'][$k]['tasks'][] = $task;
			}
		}

		$this->load->view('incubator/smme/milestone', $data);
	}

	public function createMilestoneTask($i)
	{
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$data['smme_id'] = htmlentities($i);

		$this->db->select("*");
		$query = $this->db->get("tbl_phase");
		$data['phases'] = $query->result();
			$this->db->select("*");
		$query = $this->db->get("tbl_sub_phase");
		$data['subphases'] = $query->result();

		$this->db->select('*');
		$this->db->where('tbl_users_id='.$i);
		$query = $this->db->get("tbl_users");
		$data['smme'] = $query->row();
		
		$this->load->view('incubator/smme/createMilestoneTask', $data);

	}

	public function processMilestoneTasks($id) {
		$taskAction = $_POST['taskAction'];
		if($taskAction == "getMilestoneTasks") {
			$phaseId = $_POST['phaseId'];
			$subPhaseId = $_POST['subPhaseId'];
			$smmeId = $_POST['smmeId'];

			$this->db->select("*");
			$this->db->where('phase_id', $phaseId);
			$this->db->where('subphase_id', $subPhaseId);
			$this->db->where('smme_id', $smmeId);	
			$this->db->where('task_is_active', "Y");
			$query = $this->db->get("tbl_smme_milestone_tasks");
			$data['tasks'] = $query->result();
			echo json_encode($data);

		} else if($taskAction == "createMilestoneTask") {
			$phaseId = $_POST['phaseId'];
			$subPhaseId = $_POST['subPhaseId'];
			$smmeId = $_POST['smmeId'];
			$taskName = $_POST['taskName'];
			$taskDesc = $_POST['taskDesc'];
			$taskEndDate = $_POST['taskEndDate'];
			$this->db->insert("tbl_smme_milestone_tasks", [
				"phase_id" => $phaseId,
				"subphase_id" => $subPhaseId,
				"smme_id" => $smmeId,
				"task_name" => $taskName,
				"task_description" => $taskDesc,
				"task_target_date" => $taskEndDate
			]);
		} else if($taskAction == "editMilestoneTask") {
			$taskId = $_POST['taskId'];
			$taskName = $_POST['taskName'];
			$taskDesc = $_POST['taskDesc'];
			$taskEndDate = $_POST['taskTargetDate'];
			$this->db->where("id", $taskId);
			$this->db->update("tbl_smme_milestone_tasks", [
				"task_name" => $taskName,
				"task_description" => $taskDesc,
				"task_target_date" => $taskEndDate
			]);
		} else if($taskAction == "deleteMilestoneTask") {
			$taskId = $_POST['taskId'];
			$this->db->where("id", $taskId);
			$this->db->update("tbl_smme_milestone_tasks", [
				"task_is_active" => "N"
			]);
		}  else if($taskAction == "getAllMilestoneTasks") {
			$this->db->select("tbl_application_smme_id as id");
			$this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
			$query = $this->db->get('tbl_application');
			$smmeIds = $query->result();

			$this->db->select("smme_id as id");
			$this->db->where("incubator_id", $this->session->userdata("id_user"));
			$query = $this->db->get('tbl_application_assignment');
			$smmeIds2 = $query->result();

			$all = array_merge($smmeIds, $smmeIds2);
			// to remove duplicates in $all
			$all = array_unique($all, SORT_REGULAR);
			$smmeIds = array_column($all,"id");

			$this->db->select("*");
			$this->db->where_in('smme_id', $smmeIds);	
			$this->db->where('task_is_active', "Y");
			$this->db->where('task_status', "N");
			$this->db->order_by('task_target_date', 'asc');
			$query = $this->db->get("tbl_smme_milestone_tasks");
			$data['tasks'] = $query->result();
			echo json_encode($data);
		} else {

		}
	}

    public function handleMilestoneQuestions($id)
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

        $this->load->view('incubator/smme/handleMilestoneQuestions', $data);     
    }
	
	/*public function viewdetails($id) {

        

		$data['user_id'] = $id;
		$app_id=0;
		
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		//$personal = $this->Smme_User_model->select_user_personal_data2($id);
		 $this->db->where('tbl_personal_details_user_id',$id);
        $query=$this->db->get('tbl_personal_details');
        $personal=$query->result();

		$data['personal'] = $personal;

		//$userdt = $this->Smme_User_model->select_user_data2($id);
          $this->db->join('tbl_stages as s','s.id = u.tbl_users_status','LEFT');
        $this->db->where('tbl_users_id',$id);
        $this->db->select('s.stage,u.*' );
        $query=$this->db->get('tbl_users as u');
        $userdt=$query->result();
		$data['userdt'] = $userdt;

		//$business = $this->Smme_User_model->select_user_business_data2($id);
		$this->db->join('tbl_industry','tbl_industry.tbl_industry_id = tbl_business_details.tbl_business_details_industry','LEFT');
        $this->db->join('tbl_sub_industry','tbl_sub_industry.tbl_sub_industry_id = tbl_business_details.tbl_business_details_sub_industry','LEFT');
        $this->db->where('tbl_business_details_user_id',$id);
        $query=$this->db->get('tbl_business_details');
        $business=$query->result();
		$data['business'] = $business;

		//$smme_teams = $this->Smme_User_model->select_smme_teams_data2($id);
		  $this->db->where('tbl_smme_teams_user_id',$id);
        $query=$this->db->get('tbl_smme_teams');
        $smme_teams=$query->result();
		$data['smme_teams'] = $smme_teams;
		

		
		$data['id'] = $id;

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_role_id", 3);
		$query = $this->db->get("tbl_users");
		$data['incubators'] = $query->result();

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_role_id", 4);
		$query = $this->db->get("tbl_users");
		$data['bdsps'] = $query->result();
		$this->load->view('incubator/smme/viewdetails', $data);
		
    }*/
	
	public function viewdetails($id) {

        

		$data['user_id'] = $id;
		$app_id=0;
		
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		//$personal = $this->Smme_User_model->select_user_personal_data2($id);
		 $this->db->where('tbl_personal_details_user_id',$id);
        $query=$this->db->get('tbl_personal_details');
        $personal=$query->result();

		$data['personal'] = $personal;

		//$userdt = $this->Smme_User_model->select_user_data2($id);
          $this->db->join('tbl_stages as s','s.id = u.tbl_users_status','LEFT');
        $this->db->where('tbl_users_id',$id);
        $this->db->select('s.stage,u.*' );
        $query=$this->db->get('tbl_users as u');
        $userdt=$query->result();
		$data['userdt'] = $userdt;

		//$business = $this->Smme_User_model->select_user_business_data2($id);
		$this->db->join('tbl_industry','tbl_industry.tbl_industry_id = tbl_business_details.tbl_business_details_industry','LEFT');
        $this->db->join('tbl_sub_industry','tbl_sub_industry.tbl_sub_industry_id = tbl_business_details.tbl_business_details_sub_industry','LEFT');
        $this->db->where('tbl_business_details_user_id',$id);
        $query=$this->db->get('tbl_business_details');
        $business=$query->result();
		$data['business'] = $business;
		
		$this->db->select("*");
		$this->db->where("tbl_application_smme_id", $id);
		$query = $this->db->get('tbl_application');
		$tbl_application = $query->result();
		$data['coachname']=[];
		$data['incucoachname']=[];
		if(!empty($tbl_application)){
			foreach($tbl_application as $row){
				$bdspid=$row->tbl_application_bdsp_id;
				$incuid=$row->tbl_application_incubator_id;
				$this->db->where("tbl_users_id", $bdspid);
				$query2 = $this->db->get("tbl_users");
				$coachname=$query2->result();
				$data['coachname']=$coachname;
				
				$this->db->where("tbl_users_id", $incuid);
				$query2 = $this->db->get("tbl_users");
				$coachname=$query2->result();
				$data['incucoachname']=$coachname;
			}
		}
		$data['application']=$tbl_application;

		//$smme_teams = $this->Smme_User_model->select_smme_teams_data2($id);
		  $this->db->where('tbl_smme_teams_user_id',$id);
        $query=$this->db->get('tbl_smme_teams');
        $smme_teams=$query->result();
		$data['smme_teams'] = $smme_teams;
		
		        $this->db->where("tbl_all_documents_user_id", $id);
				$this->db->where("tbl_all_documents_type","B");
				$query2 = $this->db->get("tbl_all_documents");
				$businessdoc=$query2->result();
				$data['businessdoc']=$businessdoc;
		
		$data['id'] = $id;

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_role_id", 3);
		$query = $this->db->get("tbl_users");
		$data['incubators'] = $query->result();

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_role_id", 4);
		$query = $this->db->get("tbl_users");
		$data['bdsps'] = $query->result();
		$this->load->view('incubator/smme/viewdetails', $data);
		
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
            $targetDate = $_POST['targetDate'];
            $this->db->insert("tbl_smme_question_answer", [
                "phase_id" => $phaseId,
                "subphase_id" => $subPhaseId,
                "user_id" => $smmeId,
                "question_text" => $questionText,
                "target_date" => $targetDate
                //"target_date" => date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'))
            ]);
        } else if($questionAction == "editQuestion") {
            $questionId = $_POST['questionId'];
            $questionText = $_POST['questionText'];
            $targetDate = $_POST['targetDate'];

            $this->db->where("id", $questionId);
            $this->db->where("user_id", $id);
            $this->db->update("tbl_smme_question_answer", [
                "question_text" => $questionText,
                "target_date" => $targetDate
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
                "is_answered" => true,
                "completion_date" => date("Y-m-d")
            ]);
        } else if($questionAction == "completeAll") {
            $phaseId = $_POST['phaseId'];
            $subPhaseId = $_POST['subPhaseId'];
            $smmeId = $_POST['smmeId'];            
            $this->db->where("phase_id", $phaseId);
            $this->db->where("subphase_id", $subPhaseId);
            $this->db->where("user_id", $smmeId);
            $this->db->update("tbl_smme_question_answer", [
                "is_answered" => true,
                "completion_date" => date("Y-m-d")
            ]);
		}  else if($questionAction == "getAllQuestions") {
			$this->db->select("tbl_application_smme_id as id");
			$this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
			$query = $this->db->get('tbl_application');
			$smmeIds = $query->result();

			$this->db->select("smme_id as id");
			$this->db->where("incubator_id = " . $this->session->userdata("id_user") . " AND incubator_id IS NOT NULL");
			$query = $this->db->get('tbl_application_assignment');
			$smmeIds2 = $query->result();

			$all = array_merge($smmeIds, $smmeIds2);
			// to remove duplicates in $all
			$all = array_unique($all, SORT_REGULAR);
			$smmeIds = array_column($all,"id");

			$this->db->select("*");
			$this->db->where_in('user_id', $smmeIds);	
			$this->db->where('is_answered', false);
			$this->db->where('is_deleted', false);
			$this->db->order_by('target_date', 'asc');
			$query = $this->db->get("tbl_smme_question_answer");
			$data['task_notifications'] = $query->result();
			echo json_encode($data);
		} else {

        }
    }  

	public function update_profile_image($id)
	{


		if ($_FILES['tbl_users_photo']['name'] != "") {


			unlink('assets/users/' . $this->input->post('old_tbl_users_photo'));


			$image_replace = str_replace(" ", "_", $_FILES['tbl_users_photo']['name']);

			$image_name = "users_photo_" . $this->session->userdata('user_unique_id') . "_" . $image_replace;

			$images = array(

				'tbl_users_photo' => $image_name,

			);

			$this->Smme_User_model->image_insert($images, $id, 'tbl_users', 'tbl_users_id');


			if (!empty($_FILES['tbl_users_photo']['name'])) {


				$data = [

					'user_profile_image' => $image_name,

				];

				$this->session->set_userdata($data);


				$_FILES['file']['name'] = $image_name;

				$_FILES['file']['type'] = $_FILES['tbl_users_photo']['type'];

				$_FILES['file']['tmp_name'] = $_FILES['tbl_users_photo']['tmp_name'];

				$_FILES['file']['error'] = $_FILES['tbl_users_photo']['error'];

				$_FILES['file']['size'] = $_FILES['tbl_users_photo']['size'];


				$config['upload_path'] = 'assets/users';

				$config['allowed_types'] = 'jpg|jpeg|png|gif';

				$config['max_size'] = '5000';

				$config['client_name'] = $image_name;


				$this->load->library('upload', $config);


				if ($this->upload->do_upload('file')) {

					$uploadData = $this->upload->data();

				}

			}


			$this->session->set_flashdata('success', 'Profile Photo is Successfully Updated!!!');

			redirect($_SERVER['HTTP_REFERER']);

		} else {

			$this->session->set_flashdata('danger', 'Profile Photo is Not Updated!!!');

			redirect($_SERVER['HTTP_REFERER']);

		}

	}


	public function random_password()

	{

		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_';

		$password = array();

		$alpha_length = strlen($alphabet) - 1;

		for ($i = 0; $i < 11; $i++) {

			$n = rand(0, $alpha_length);

			$password[] = $alphabet[$n];

		}

		$newpass = implode($password);

		return $newpass;

	}


	public function add()
	{


		if ($_POST) {

			//echo "<pre>";

			//print_r($_POST);

			//print_r($_FILES['files']['name']);//exit;

			$now = date("Y-m-d H:i:s");

			$randomid = mt_rand(100000, 999999);

			//echo $randomid;

			$user = array(


				'tbl_users_user_uniqueid' => $randomid,


				'tbl_users_role_id' => '2',


				'tbl_users_firstname' => $this->input->post('tbl_users_firstname'),


				'tbl_users_lastname' => $this->input->post('tbl_users_lastname'),


				'tbl_users_email' => $this->input->post('tbl_users_email'),


				'tbl_users_password' => md5($this->input->post('tbl_users_password')),


				'tbl_users_contrycode' => $this->input->post('tbl_users_contrycode'),


				'tbl_users_mobile' => $this->input->post('tbl_users_mobile'),


				'tbl_users_gender' => $this->input->post('tbl_users_gender'),


				'tbl_users_insertdate' => $now,


			);

			$personal = array(


				'tbl_personal_details_occupation' => $this->input->post('tbl_personal_details_occupation'),


				'tbl_personal_details_dob' => $this->input->post('tbl_personal_details_dob'),


				'tbl_personal_details_optional_telephone' => $this->input->post('tbl_personal_details_optional_telephone'),


				'tbl_personal_details_howdidyouknow' => $this->input->post('tbl_personal_details_howdidyouknow'),


				'tbl_personal_details_education' => $this->input->post('tbl_personal_details_education'),


				'tbl_personal_details_district' => $this->input->post('tbl_personal_details_district'),


				'tbl_personal_details_town_village' => $this->input->post('tbl_personal_details_town_village'),


				'tbl_personal_details_postcode' => $this->input->post('tbl_personal_details_postcode'),


				'tbl_personal_details_insertdate' => $now,


			);

			$business = array(


				'tbl_business_details_name' => $this->input->post('tbl_business_details_name'),


				'tbl_business_details_industry' => $this->input->post('tbl_business_details_industry'),


				'tbl_business_details_email' => $this->input->post('tbl_business_details_email'),


				'tbl_business_details_phone' => $this->input->post('tbl_business_details_phone'),


				'tbl_business_details_district' => $this->input->post('tbl_business_details_district'),


				'tbl_business_details_town_village' => $this->input->post('tbl_business_details_town_village'),


				'tbl_business_details_employees' => $this->input->post('tbl_business_details_employees'),


				'tbl_business_details_investmant_need' => $this->input->post('tbl_business_details_investmant_need'),


				'tbl_business_details_areyouteam' => $this->input->post('tbl_business_details_areyouteam'),


				'tbl_business_details_insertdate' => $now,


			);


			$smme_teams = array(


				'tbl_smme_teams_first_name' => $this->input->post('tbl_smme_teams_first_name'),


				'tbl_smme_teams_last_name' => $this->input->post('tbl_smme_teams_last_name'),


				'tbl_smme_teams_email' => $this->input->post('tbl_smme_teams_email'),


				'tbl_smme_teams_mobile' => $this->input->post('tbl_smme_teams_mobile'),


				'tbl_smme_teams_insertdate' => $now,


			);

			$result = $this->Smme_User_model->insert_master($user, $personal, $business, $smme_teams);

			$user_id = explode('^', $result);

			if ($result[0] == 1) {

				if ($_FILES['tbl_users_photo']['name'] != "") {

					$image_replace = str_replace(" ", "_", $_FILES['tbl_users_photo']['name']);

					$image_name = "users_photo_" . $randomid . "_" . $image_replace;

					$images = array(

						'tbl_users_photo' => $image_name,

					);

					$this->Smme_User_model->image_insert($images, $user_id[1], 'tbl_users', 'tbl_users_id');


					if (!empty($_FILES['tbl_users_photo']['name'])) {


						$_FILES['file']['name'] = $image_name;

						$_FILES['file']['type'] = $_FILES['tbl_users_photo']['type'];

						$_FILES['file']['tmp_name'] = $_FILES['tbl_users_photo']['tmp_name'];

						$_FILES['file']['error'] = $_FILES['tbl_users_photo']['error'];

						$_FILES['file']['size'] = $_FILES['tbl_users_photo']['size'];


						$config['upload_path'] = 'assets/users';

						$config['allowed_types'] = 'jpg|jpeg|png|gif';

						$config['max_size'] = '5000';

						$config['client_name'] = $image_name;


						$this->load->library('upload', $config);


						if ($this->upload->do_upload('file')) {

							//echo "if";

							$uploadData = $this->upload->data();

							/* echo "<pre>";

							 print_r($uploadData);exit();*/

							$filename = $uploadData['client_name'];

							$data1['totalFiles'][] = $filename;

						}

					}

				}

				if ($_FILES['tbl_personal_details_educational_doc']['name'] != "") {

					$image_replace = str_replace(" ", "_", $_FILES['tbl_personal_details_educational_doc']['name']);

					$image_name = "edu_doc_photo_" . $randomid . "_" . $image_replace;

					$images = array(

						'tbl_personal_details_educational_doc' => $image_name,

					);

					$this->Smme_User_model->image_insert($images, $user_id[1], 'tbl_personal_details', 'tbl_personal_details_user_id');


					if (!empty($_FILES['tbl_personal_details_educational_doc']['name'])) {


						$_FILES['file']['name'] = $image_name;

						$_FILES['file']['type'] = $_FILES['tbl_personal_details_educational_doc']['type'];

						$_FILES['file']['tmp_name'] = $_FILES['tbl_personal_details_educational_doc']['tmp_name'];

						$_FILES['file']['error'] = $_FILES['tbl_personal_details_educational_doc']['error'];

						$_FILES['file']['size'] = $_FILES['tbl_personal_details_educational_doc']['size'];


						$config['upload_path'] = 'assets/users';

						$config['allowed_types'] = 'jpg|jpeg|png|gif';

						$config['max_size'] = '5000';

						$config['client_name'] = $image_name;


						$this->load->library('upload', $config);


						if ($this->upload->do_upload('file')) {

							//echo "if";

							$uploadData = $this->upload->data();

							/* echo "<pre>";

							 print_r($uploadData);exit();*/

							$filename = $uploadData['client_name'];

							$data1['totalFiles'][] = $filename;

						}

					}

				}

				if ($_FILES['tbl_business_details_business_doc']['name'] != "") {

					$image_replace = str_replace(" ", "_", $_FILES['tbl_business_details_business_doc']['name']);

					$image_name = "business_doc_photo_" . $randomid . "_" . $image_replace;

					$images = array(

						'tbl_business_details_business_doc' => $image_name,

					);

					$this->Smme_User_model->image_insert($images, $user_id[1], 'tbl_business_details', 'tbl_business_details_user_id');


					if (!empty($_FILES['tbl_business_details_business_doc']['name'])) {


						$_FILES['file']['name'] = $image_name;

						$_FILES['file']['type'] = $_FILES['tbl_business_details_business_doc']['type'];

						$_FILES['file']['tmp_name'] = $_FILES['tbl_business_details_business_doc']['tmp_name'];

						$_FILES['file']['error'] = $_FILES['tbl_business_details_business_doc']['error'];

						$_FILES['file']['size'] = $_FILES['tbl_business_details_business_doc']['size'];


						$config['upload_path'] = 'assets/users';

						$config['allowed_types'] = 'jpg|jpeg|png|gif';

						$config['max_size'] = '5000';

						$config['client_name'] = $image_name;


						$this->load->library('upload', $config);


						if ($this->upload->do_upload('file')) {

							//echo "if";

							$uploadData = $this->upload->data();

							/* echo "<pre>";

							 print_r($uploadData);exit();*/

							$filename = $uploadData['client_name'];

							$data1['totalFiles'][] = $filename;

						}

					}

				}

				$this->session->set_flashdata('success', 'Data Inserted Successfully!');

				//redirect($_SERVER['HTTP_REFERER']);

				redirect('admin/smme');

			}

			if ($result == 2) {

				$this->session->set_flashdata('danger', 'Username or Email id is Duplicate!');

				//redirect($_SERVER['HTTP_REFERER']);

				redirect('admin/smme');

			} elseif ($result == 0) {

				$this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');

				//redirect($_SERVER['HTTP_REFERER']);

				redirect('admin/smme');

			}

		}

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);


		$role = $this->Smme_User_model->select_all_role();

		$data['role'] = $role;

		$array = [

			'44' => 'UK (+44)',

			'1' => 'USA (+1)',

			'213' => 'Algeria (+213)',

			'376' => 'Andorra (+376)',

			'244' => 'Angola (+244)',

			'1264' => 'Anguilla (+1264)',

			'1268' => 'Antigua & Barbuda (+1268)',

			'54' => 'Argentina (+54)',

			'374' => 'Armenia (+374)',

			'297' => 'Aruba (+297)',

			'61' => 'Australia (+61)',

			'43' => 'Austria (+43)',

			'994' => 'Azerbaijan (+994)',

			'1242' => 'Bahamas (+1242)',

			'973' => 'Bahrain (+973)',

			'880' => 'Bangladesh (+880)',

			'1246' => 'Barbados (+1246)',

			'375' => 'Belarus (+375)',

			'32' => 'Belgium (+32)',

			'501' => 'Belize (+501)',

			'229' => 'Benin (+229)',

			'1441' => 'Bermuda (+1441)',

			'975' => 'Bhutan (+975)',

			'591' => 'Bolivia (+591)',

			'387' => 'Bosnia Herzegovina (+387)',

			'267' => 'Botswana (+267)',

			'55' => 'Brazil (+55)',

			'673' => 'Brunei (+673)',

			'359' => 'Bulgaria (+359)',

			'226' => 'Burkina Faso (+226)',

			'257' => 'Burundi (+257)',

			'855' => 'Cambodia (+855)',

			'237' => 'Cameroon (+237)',

			'1' => 'Canada (+1)',

			'238' => 'Cape Verde Islands (+238)',

			'1345' => 'Cayman Islands (+1345)',

			'236' => 'Central African Republic (+236)',

			'56' => 'Chile (+56)',

			'86' => 'China (+86)',

			'57' => 'Colombia (+57)',

			'269' => 'Comoros (+269)',

			'242' => 'Congo (+242)',

			'682' => 'Cook Islands (+682)',

			'506' => 'Costa Rica (+506)',

			'385' => 'Croatia (+385)',

			'53' => 'Cuba (+53)',

			'90392' => 'Cyprus North (+90392)',

			'357' => 'Cyprus South (+357)',

			'42' => 'Czech Republic (+42)',

			'45' => 'Denmark (+45)',

			'253' => 'Djibouti (+253)',

			'1809' => 'Dominica (+1809)',

			'1809' => 'Dominican Republic (+1809)',

			'593' => 'Ecuador (+593)',

			'20' => 'Egypt (+20)',

			'503' => 'El Salvador (+503)',

			'240' => 'Equatorial Guinea (+240)',

			'291' => 'Eritrea (+291)',

			'372' => 'Estonia (+372)',

			'251' => 'Ethiopia (+251)',

			'500' => 'Falkland Islands (+500)',

			'298' => 'Faroe Islands (+298)',

			'679' => 'Fiji (+679)',

			'358' => 'Finland (+358)',

			'33' => 'France (+33)',

			'594' => 'French Guiana (+594)',

			'689' => 'French Polynesia (+689)',

			'241' => 'Gabon (+241)',

			'220' => 'Gambia (+220)',

			'7880' => 'Georgia (+7880)',

			'49' => 'Germany (+49)',

			'233' => 'Ghana (+233)',

			'350' => 'Gibraltar (+350)',

			'30' => 'Greece (+30)',

			'299' => 'Greenland (+299)',

			'1473' => 'Grenada (+1473)',

			'590' => 'Guadeloupe (+590)',

			'671' => 'Guam (+671)',

			'502' => 'Guatemala (+502)',

			'224' => 'Guinea (+224)',

			'245' => 'Guinea - Bissau (+245)',

			'592' => 'Guyana (+592)',

			'509' => 'Haiti (+509)',

			'504' => 'Honduras (+504)',

			'852' => 'Hong Kong (+852)',

			'36' => 'Hungary (+36)',

			'354' => 'Iceland (+354)',

			'91' => 'India (+91)',

			'62' => 'Indonesia (+62)',

			'98' => 'Iran (+98)',

			'964' => 'Iraq (+964)',

			'353' => 'Ireland (+353)',

			'972' => 'Israel (+972)',

			'39' => 'Italy (+39)',

			'1876' => 'Jamaica (+1876)',

			'81' => 'Japan (+81)',

			'962' => 'Jordan (+962)',

			'7' => 'Kazakhstan (+7)',

			'254' => 'Kenya (+254)',

			'686' => 'Kiribati (+686)',

			'850' => 'Korea North (+850)',

			'82' => 'Korea South (+82)',

			'965' => 'Kuwait (+965)',

			'996' => 'Kyrgyzstan (+996)',

			'856' => 'Laos (+856)',

			'371' => 'Latvia (+371)',

			'961' => 'Lebanon (+961)',

			'266' => 'Lesotho (+266)',

			'231' => 'Liberia (+231)',

			'218' => 'Libya (+218)',

			'417' => 'Liechtenstein (+417)',

			'370' => 'Lithuania (+370)',

			'352' => 'Luxembourg (+352)',

			'853' => 'Macao (+853)',

			'389' => 'Macedonia (+389)',

			'261' => 'Madagascar (+261)',

			'265' => 'Malawi (+265)',

			'60' => 'Malaysia (+60)',

			'960' => 'Maldives (+960)',

			'223' => 'Mali (+223)',

			'356' => 'Malta (+356)',

			'692' => 'Marshall Islands (+692)',

			'596' => 'Martinique (+596)',

			'222' => 'Mauritania (+222)',

			'269' => 'Mayotte (+269)',

			'52' => 'Mexico (+52)',

			'691' => 'Micronesia (+691)',

			'373' => 'Moldova (+373)',

			'377' => 'Monaco (+377)',

			'976' => 'Mongolia (+976)',

			'1664' => 'Montserrat (+1664)',

			'212' => 'Morocco (+212)',

			'258' => 'Mozambique (+258)',

			'95' => 'Myanmar (+95)',

			'264' => 'Namibia (+264)',

			'674' => 'Nauru (+674)',

			'977' => 'Nepal (+977)',

			'31' => 'Netherlands (+31)',

			'687' => 'New Caledonia (+687)',

			'64' => 'New Zealand (+64)',

			'505' => 'Nicaragua (+505)',

			'227' => 'Niger (+227)',

			'234' => 'Nigeria (+234)',

			'683' => 'Niue (+683)',

			'672' => 'Norfolk Islands (+672)',

			'670' => 'Northern Marianas (+670)',

			'47' => 'Norway (+47)',

			'968' => 'Oman (+968)',

			'680' => 'Palau (+680)',

			'507' => 'Panama (+507)',

			'675' => 'Papua New Guinea (+675)',

			'595' => 'Paraguay (+595)',

			'51' => 'Peru (+51)',

			'63' => 'Philippines (+63)',

			'48' => 'Poland (+48)',

			'351' => 'Portugal (+351)',

			'1787' => 'Puerto Rico (+1787)',

			'974' => 'Qatar (+974)',

			'262' => 'Reunion (+262)',

			'40' => 'Romania (+40)',

			'7' => 'Russia (+7)',

			'250' => 'Rwanda (+250)',

			'378' => 'San Marino (+378)',

			'239' => 'Sao Tome & Principe (+239)',

			'966' => 'Saudi Arabia (+966)',

			'221' => 'Senegal (+221)',

			'381' => 'Serbia (+381)',

			'248' => 'Seychelles (+248)',

			'232' => 'Sierra Leone (+232)',

			'65' => 'Singapore (+65)',

			'421' => 'Slovak Republic (+421)',

			'386' => 'Slovenia (+386)',

			'677' => 'Solomon Islands (+677)',

			'252' => 'Somalia (+252)',

			'27' => 'South Africa (+27)',

			'34' => 'Spain (+34)',

			'94' => 'Sri Lanka (+94)',

			'290' => 'St. Helena (+290)',

			'1869' => 'St. Kitts (+1869)',

			'1758' => 'St. Lucia (+1758)',

			'249' => 'Sudan (+249)',

			'597' => 'Suriname (+597)',

			'268' => 'Swaziland (+268)',

			'46' => 'Sweden (+46)',

			'41' => 'Switzerland (+41)',

			'963' => 'Syria (+963)',

			'886' => 'Taiwan (+886)',

			'7' => 'Tajikstan (+7)',

			'66' => 'Thailand (+66)',

			'228' => 'Togo (+228)',

			'676' => 'Tonga (+676)',

			'1868' => 'Trinidad & Tobago (+1868)',

			'216' => 'Tunisia (+216)',

			'90' => 'Turkey (+90)',

			'7' => 'Turkmenistan (+7)',

			'993' => 'Turkmenistan (+993)',

			'1649' => 'Turks & Caicos Islands (+1649)',

			'688' => 'Tuvalu (+688)',

			'256' => 'Uganda (+256)',

			'380' => 'Ukraine (+380)',

			'971' => 'United Arab Emirates (+971)',

			'598' => 'Uruguay (+598)',

			'7' => 'Uzbekistan (+7)',

			'678' => 'Vanuatu (+678)',

			'379' => 'Vatican City (+379)',

			'58' => 'Venezuela (+58)',

			'84' => 'Vietnam (+84)',

			'84' => 'Virgin Islands - British (+1284)',

			'84' => 'Virgin Islands - US (+1340)',

			'681' => 'Wallis & Futuna (+681)',

			'969' => 'Yemen (North)(+969)',

			'967' => 'Yemen (South)(+967)',

			'260' => 'Zambia (+260)',

			'263' => 'Zimbabwe (+263)',];

		$data['array'] = $array;


		$this->load->view('admin/smme/add', $data);


	}

	public function smme()

	{


		$result = $this->Smme_User_model->select_all_smme_data_view();

		$data['tdata'] = $result;

		/* $datad['d'] = $result;

		 $datad['dd'] = $this->session->userdata('user_id');*/

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view('admin/smme/index', $data);

	}

	public function incubators()

	{


		$result = $this->Smme_User_model->select_all_incubators_data_view();

		$data['tdata'] = $result;

		//print_r($result);exit;

		/* $datad['d'] = $result;

		 $datad['dd'] = $this->session->userdata('user_id');*/

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view('admin/smme/index', $data);

	}

	public function login_history()
	{


		$id = $this->input->post('user_id');

		$result = $this->Smme_User_model->login_history($id);

		//print_r($result);exit;

		echo json_encode($result);

	}

	public function bdsps()

	{


		$result = $this->Smme_User_model->select_all_bdsps_data_view();

		$data['tdata'] = $result;

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->load->view('admin/smme/index', $data);

	}

	public function createTask($i)
	{
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$data['smme_id'] = htmlentities($i);

		$this->db->select('tbl_board_title as title, tbl_board_title as id, tbl_board_id as brd_id');
		$this->db->where('tbl_board_smme_unique_id', $i);
		$query = $this->db->get("tbl_board");
		$data['boards'] = $query->result();

		for ($i = 0; $i < count($data['boards']); $i++) {

			$this->db->select('tbl_boardlist_title as title, tbl_boardlist_title as id');
			$this->db->where('tbl_boardlist_board_id', $data['boards'][$i]->brd_id);
			$this->db->order_by("tbl_boardlist_index ASC");
			$query = $this->db->get("tbl_boardlist");
			$items = $query->result();

			$boardItems = [];
			foreach ($items as $item) {
				$boardItems[] = [
					"id" => $item->id,
					"title" => $item->title
				];
			}

			$data['boards'][$i]->item = $boardItems;
		}

		$data['boards'] = json_encode($data['boards']);

		$this->load->view('incubator/smme/createTask', $data);
	}

	public function updateElement()
	{
		$this->db->select('tbl_board_id as id');
		$this->db->where('tbl_board_title', $_POST['boardId']);
		$this->db->where('tbl_board_smme_unique_id', $_POST['smmeId']);
		$query = $this->db->get("tbl_board");
		$board = $query->result();

		$id = trim($_POST['id']);

		$this->db->where("tbl_boardlist_title='{$id}'");
		$this->db->where("tbl_boardlist_board_id='{$board[0]->id}'");
		$this->db->update("tbl_boardlist", [
			"tbl_boardlist_title" => $_POST['title'],
			"end_date" => $_POST['end_date']
		]);
	}

	public function deleteElement()
	{
		$this->db->select('tbl_board_id as id');
		$this->db->where('tbl_board_title', $_POST['boardId']);
		$this->db->where('tbl_board_smme_unique_id', $_POST['smmeId']);
		$query = $this->db->get("tbl_board");
		$board = $query->result();

		$title = trim($_POST['id']);
		$this->db->where("tbl_boardlist_title='" . $title . "' AND tbl_boardlist_board_id='" . $board[0]->id . "'");
		$this->db->delete('tbl_boardlist');
	}

	public function orderElements()
	{
		$this->db->select('tbl_board_id as id');
		$this->db->where('tbl_board_title', $_POST['boardId']);
		$this->db->where('tbl_board_smme_unique_id', $_POST['smme']);
		$query = $this->db->get("tbl_board");
		$board = $query->result();

		foreach ($_POST['order'] as $key => $item) {
			$this->db->where("tbl_boardlist_title='{$item}'");
			$this->db->update("tbl_boardlist", [
				"tbl_boardlist_board_id" => $board[0]->id,
				"tbl_boardlist_index" => $key + 1
			]);
		}
	}

	public function saveElement()
	{
		$this->db->select('tbl_board_id as id');
		$this->db->where('tbl_board_title', $_POST['brdID']);
		$query = $this->db->get("tbl_board");
		$board = $query->result();

		$this->db->insert("tbl_boardlist", [
			"tbl_boardlist_board_id" => $board[0]->id,
			"tbl_boardlist_title" => $_POST['title'],
			"tbl_boardlist_index" => $_POST['index'],
			"tbl_boardlist_insertdate" => date("Y-m-d H:i:s"),
			"tbl_boardlist_updatedate" => date("Y-m-d H:i:s")
		]);
	}

	public function saveBoard()
	{
		$this->db->insert("tbl_board", [
			"tbl_board_user_unique_id" => $this->session->userdata("id_admin"),
			"tbl_board_smme_unique_id" => $_POST['smmeId'],
			"tbl_board_title" => $_POST['title'],
			"tbl_board_insertdate" => date("Y-m-d H:i:s"),
			"tbl_board_updatedate" => date("Y-m-d H:i:s")
		]);
	}

	public function edit($i)
	{

		//print_r($i);

		$editdt = $this->Smme_User_model->select_user_data($i);

		$personal = $this->Smme_User_model->select_user_personal_data($i);

		$business = $this->Smme_User_model->select_user_business_data($i);

		$smme_teams = $this->Smme_User_model->select_smme_teams_data($i);

		$role = $this->Smme_User_model->select_all_role();

		$data['role'] = $role;


		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$data['userdt'] = $editdt;

		$data['personal'] = $personal;

		$data['business'] = $business;

		$data['smme_teams'] = $smme_teams;

		//$this->load->view ('home', $data);

		// print_r($editdt);exit;

		$array = [

			'44' => 'UK (+44)',

			'1' => 'USA (+1)',

			'213' => 'Algeria (+213)',

			'376' => 'Andorra (+376)',

			'244' => 'Angola (+244)',

			'1264' => 'Anguilla (+1264)',

			'1268' => 'Antigua & Barbuda (+1268)',

			'54' => 'Argentina (+54)',

			'374' => 'Armenia (+374)',

			'297' => 'Aruba (+297)',

			'61' => 'Australia (+61)',

			'43' => 'Austria (+43)',

			'994' => 'Azerbaijan (+994)',

			'1242' => 'Bahamas (+1242)',

			'973' => 'Bahrain (+973)',

			'880' => 'Bangladesh (+880)',

			'1246' => 'Barbados (+1246)',

			'375' => 'Belarus (+375)',

			'32' => 'Belgium (+32)',

			'501' => 'Belize (+501)',

			'229' => 'Benin (+229)',

			'1441' => 'Bermuda (+1441)',

			'975' => 'Bhutan (+975)',

			'591' => 'Bolivia (+591)',

			'387' => 'Bosnia Herzegovina (+387)',

			'267' => 'Botswana (+267)',

			'55' => 'Brazil (+55)',

			'673' => 'Brunei (+673)',

			'359' => 'Bulgaria (+359)',

			'226' => 'Burkina Faso (+226)',

			'257' => 'Burundi (+257)',

			'855' => 'Cambodia (+855)',

			'237' => 'Cameroon (+237)',

			'1' => 'Canada (+1)',

			'238' => 'Cape Verde Islands (+238)',

			'1345' => 'Cayman Islands (+1345)',

			'236' => 'Central African Republic (+236)',

			'56' => 'Chile (+56)',

			'86' => 'China (+86)',

			'57' => 'Colombia (+57)',

			'269' => 'Comoros (+269)',

			'242' => 'Congo (+242)',

			'682' => 'Cook Islands (+682)',

			'506' => 'Costa Rica (+506)',

			'385' => 'Croatia (+385)',

			'53' => 'Cuba (+53)',

			'90392' => 'Cyprus North (+90392)',

			'357' => 'Cyprus South (+357)',

			'42' => 'Czech Republic (+42)',

			'45' => 'Denmark (+45)',

			'253' => 'Djibouti (+253)',

			'1809' => 'Dominica (+1809)',

			'1809' => 'Dominican Republic (+1809)',

			'593' => 'Ecuador (+593)',

			'20' => 'Egypt (+20)',

			'503' => 'El Salvador (+503)',

			'240' => 'Equatorial Guinea (+240)',

			'291' => 'Eritrea (+291)',

			'372' => 'Estonia (+372)',

			'251' => 'Ethiopia (+251)',

			'500' => 'Falkland Islands (+500)',

			'298' => 'Faroe Islands (+298)',

			'679' => 'Fiji (+679)',

			'358' => 'Finland (+358)',

			'33' => 'France (+33)',

			'594' => 'French Guiana (+594)',

			'689' => 'French Polynesia (+689)',

			'241' => 'Gabon (+241)',

			'220' => 'Gambia (+220)',

			'7880' => 'Georgia (+7880)',

			'49' => 'Germany (+49)',

			'233' => 'Ghana (+233)',

			'350' => 'Gibraltar (+350)',

			'30' => 'Greece (+30)',

			'299' => 'Greenland (+299)',

			'1473' => 'Grenada (+1473)',

			'590' => 'Guadeloupe (+590)',

			'671' => 'Guam (+671)',

			'502' => 'Guatemala (+502)',

			'224' => 'Guinea (+224)',

			'245' => 'Guinea - Bissau (+245)',

			'592' => 'Guyana (+592)',

			'509' => 'Haiti (+509)',

			'504' => 'Honduras (+504)',

			'852' => 'Hong Kong (+852)',

			'36' => 'Hungary (+36)',

			'354' => 'Iceland (+354)',

			'91' => 'India (+91)',

			'62' => 'Indonesia (+62)',

			'98' => 'Iran (+98)',

			'964' => 'Iraq (+964)',

			'353' => 'Ireland (+353)',

			'972' => 'Israel (+972)',

			'39' => 'Italy (+39)',

			'1876' => 'Jamaica (+1876)',

			'81' => 'Japan (+81)',

			'962' => 'Jordan (+962)',

			'7' => 'Kazakhstan (+7)',

			'254' => 'Kenya (+254)',

			'686' => 'Kiribati (+686)',

			'850' => 'Korea North (+850)',

			'82' => 'Korea South (+82)',

			'965' => 'Kuwait (+965)',

			'996' => 'Kyrgyzstan (+996)',

			'856' => 'Laos (+856)',

			'371' => 'Latvia (+371)',

			'961' => 'Lebanon (+961)',

			'266' => 'Lesotho (+266)',

			'231' => 'Liberia (+231)',

			'218' => 'Libya (+218)',

			'417' => 'Liechtenstein (+417)',

			'370' => 'Lithuania (+370)',

			'352' => 'Luxembourg (+352)',

			'853' => 'Macao (+853)',

			'389' => 'Macedonia (+389)',

			'261' => 'Madagascar (+261)',

			'265' => 'Malawi (+265)',

			'60' => 'Malaysia (+60)',

			'960' => 'Maldives (+960)',

			'223' => 'Mali (+223)',

			'356' => 'Malta (+356)',

			'692' => 'Marshall Islands (+692)',

			'596' => 'Martinique (+596)',

			'222' => 'Mauritania (+222)',

			'269' => 'Mayotte (+269)',

			'52' => 'Mexico (+52)',

			'691' => 'Micronesia (+691)',

			'373' => 'Moldova (+373)',

			'377' => 'Monaco (+377)',

			'976' => 'Mongolia (+976)',

			'1664' => 'Montserrat (+1664)',

			'212' => 'Morocco (+212)',

			'258' => 'Mozambique (+258)',

			'95' => 'Myanmar (+95)',

			'264' => 'Namibia (+264)',

			'674' => 'Nauru (+674)',

			'977' => 'Nepal (+977)',

			'31' => 'Netherlands (+31)',

			'687' => 'New Caledonia (+687)',

			'64' => 'New Zealand (+64)',

			'505' => 'Nicaragua (+505)',

			'227' => 'Niger (+227)',

			'234' => 'Nigeria (+234)',

			'683' => 'Niue (+683)',

			'672' => 'Norfolk Islands (+672)',

			'670' => 'Northern Marianas (+670)',

			'47' => 'Norway (+47)',

			'968' => 'Oman (+968)',

			'680' => 'Palau (+680)',

			'507' => 'Panama (+507)',

			'675' => 'Papua New Guinea (+675)',

			'595' => 'Paraguay (+595)',

			'51' => 'Peru (+51)',

			'63' => 'Philippines (+63)',

			'48' => 'Poland (+48)',

			'351' => 'Portugal (+351)',

			'1787' => 'Puerto Rico (+1787)',

			'974' => 'Qatar (+974)',

			'262' => 'Reunion (+262)',

			'40' => 'Romania (+40)',

			'7' => 'Russia (+7)',

			'250' => 'Rwanda (+250)',

			'378' => 'San Marino (+378)',

			'239' => 'Sao Tome & Principe (+239)',

			'966' => 'Saudi Arabia (+966)',

			'221' => 'Senegal (+221)',

			'381' => 'Serbia (+381)',

			'248' => 'Seychelles (+248)',

			'232' => 'Sierra Leone (+232)',

			'65' => 'Singapore (+65)',

			'421' => 'Slovak Republic (+421)',

			'386' => 'Slovenia (+386)',

			'677' => 'Solomon Islands (+677)',

			'252' => 'Somalia (+252)',

			'27' => 'South Africa (+27)',

			'34' => 'Spain (+34)',

			'94' => 'Sri Lanka (+94)',

			'290' => 'St. Helena (+290)',

			'1869' => 'St. Kitts (+1869)',

			'1758' => 'St. Lucia (+1758)',

			'249' => 'Sudan (+249)',

			'597' => 'Suriname (+597)',

			'268' => 'Swaziland (+268)',

			'46' => 'Sweden (+46)',

			'41' => 'Switzerland (+41)',

			'963' => 'Syria (+963)',

			'886' => 'Taiwan (+886)',

			'7' => 'Tajikstan (+7)',

			'66' => 'Thailand (+66)',

			'228' => 'Togo (+228)',

			'676' => 'Tonga (+676)',

			'1868' => 'Trinidad & Tobago (+1868)',

			'216' => 'Tunisia (+216)',

			'90' => 'Turkey (+90)',

			'7' => 'Turkmenistan (+7)',

			'993' => 'Turkmenistan (+993)',

			'1649' => 'Turks & Caicos Islands (+1649)',

			'688' => 'Tuvalu (+688)',

			'256' => 'Uganda (+256)',

			'380' => 'Ukraine (+380)',

			'971' => 'United Arab Emirates (+971)',

			'598' => 'Uruguay (+598)',

			'7' => 'Uzbekistan (+7)',

			'678' => 'Vanuatu (+678)',

			'379' => 'Vatican City (+379)',

			'58' => 'Venezuela (+58)',

			'84' => 'Vietnam (+84)',

			'84' => 'Virgin Islands - British (+1284)',

			'84' => 'Virgin Islands - US (+1340)',

			'681' => 'Wallis & Futuna (+681)',

			'969' => 'Yemen (North)(+969)',

			'967' => 'Yemen (South)(+967)',

			'260' => 'Zambia (+260)',

			'263' => 'Zimbabwe (+263)',];

		$data['array'] = $array;

		$this->load->view('admin/smme/edit', $data);


	}


	public function update($upd_id)
	{

		//echo $upd_id;exit;

		//print_r($_POST);exit();

		if ($_POST) {

			$now = date("Y-m-d H:i:s");

			$randomid = mt_rand(100000, 999999);

			//echo $randomid;

			$user = array(


				'tbl_users_firstname' => $this->input->post('tbl_users_firstname'),


				'tbl_users_lastname' => $this->input->post('tbl_users_lastname'),


				'tbl_users_contrycode' => $this->input->post('tbl_users_contrycode'),


				'tbl_users_mobile' => $this->input->post('tbl_users_mobile'),


				'tbl_users_gender' => $this->input->post('tbl_users_gender'),


			);

			$personal = array(


				'tbl_personal_details_occupation' => $this->input->post('tbl_personal_details_occupation'),


				'tbl_personal_details_dob' => $this->input->post('tbl_personal_details_dob'),


				'tbl_personal_details_optional_telephone' => $this->input->post('tbl_personal_details_optional_telephone'),


				'tbl_personal_details_howdidyouknow' => $this->input->post('tbl_personal_details_howdidyouknow'),


				'tbl_personal_details_education' => $this->input->post('tbl_personal_details_education'),


				'tbl_personal_details_district' => $this->input->post('tbl_personal_details_district'),


				'tbl_personal_details_town_village' => $this->input->post('tbl_personal_details_town_village'),


				'tbl_personal_details_postcode' => $this->input->post('tbl_personal_details_postcode'),


			);

			$business = array(


				'tbl_business_details_name' => $this->input->post('tbl_business_details_name'),


				'tbl_business_details_industry' => $this->input->post('tbl_business_details_industry'),


				'tbl_business_details_email' => $this->input->post('tbl_business_details_email'),


				'tbl_business_details_phone' => $this->input->post('tbl_business_details_phone'),


				'tbl_business_details_district' => $this->input->post('tbl_business_details_district'),


				'tbl_business_details_town_village' => $this->input->post('tbl_business_details_town_village'),


				'tbl_business_details_employees' => $this->input->post('tbl_business_details_employees'),


				'tbl_business_details_investmant_need' => $this->input->post('tbl_business_details_investmant_need'),


				'tbl_business_details_areyouteam' => $this->input->post('tbl_business_details_areyouteam'),

			);


			$smme_teams = array(


				'tbl_smme_teams_first_name' => $this->input->post('tbl_smme_teams_first_name'),


				'tbl_smme_teams_last_name' => $this->input->post('tbl_smme_teams_last_name'),


				'tbl_smme_teams_email' => $this->input->post('tbl_smme_teams_email'),


				'tbl_smme_teams_mobile' => $this->input->post('tbl_smme_teams_mobile'),


				'tbl_smme_teams_insertdate' => $now,


			);

			$result = $this->Smme_User_model->update_master($user, $personal, $business, $smme_teams, $upd_id, $this->input->post('tbl_personal_details_id'), $this->input->post('tbl_business_details_id'));

			$user_id = explode('^', $result);

			if ($result[0] == 1) {

				if ($_FILES['tbl_users_photo']['name'] != "") {

					$image_replace = str_replace(" ", "_", $_FILES['tbl_users_photo']['name']);

					$image_name = "users_photo_" . $randomid . "_" . $image_replace;

					$images = array(

						'tbl_users_photo' => $image_name,

					);

					$this->Smme_User_model->image_insert($images, $upd_id, 'tbl_users', 'tbl_users_id');


					if (!empty($_FILES['tbl_users_photo']['name'])) {


						$_FILES['file']['name'] = $image_name;

						$_FILES['file']['type'] = $_FILES['tbl_users_photo']['type'];

						$_FILES['file']['tmp_name'] = $_FILES['tbl_users_photo']['tmp_name'];

						$_FILES['file']['error'] = $_FILES['tbl_users_photo']['error'];

						$_FILES['file']['size'] = $_FILES['tbl_users_photo']['size'];


						$config['upload_path'] = 'assets/users';

						$config['allowed_types'] = 'jpg|jpeg|png|gif';

						$config['max_size'] = '5000';

						$config['client_name'] = $image_name;


						$this->load->library('upload', $config);


						if ($this->upload->do_upload('file')) {

							//echo "if";

							$uploadData = $this->upload->data();

							/* echo "<pre>";

							 print_r($uploadData);exit();*/

							$filename = $uploadData['client_name'];

							$data1['totalFiles'][] = $filename;

						}

					}

				}

				if ($_FILES['tbl_personal_details_educational_doc']['name'] != "") {

					$image_replace = str_replace(" ", "_", $_FILES['tbl_personal_details_educational_doc']['name']);

					$image_name = "edu_doc_photo_" . $randomid . "_" . $image_replace;

					$images = array(

						'tbl_personal_details_educational_doc' => $image_name,

					);

					$this->Smme_User_model->image_insert($images, $upd_id, 'tbl_personal_details', 'tbl_personal_details_user_id');


					if (!empty($_FILES['tbl_personal_details_educational_doc']['name'])) {


						$_FILES['file']['name'] = $image_name;

						$_FILES['file']['type'] = $_FILES['tbl_personal_details_educational_doc']['type'];

						$_FILES['file']['tmp_name'] = $_FILES['tbl_personal_details_educational_doc']['tmp_name'];

						$_FILES['file']['error'] = $_FILES['tbl_personal_details_educational_doc']['error'];

						$_FILES['file']['size'] = $_FILES['tbl_personal_details_educational_doc']['size'];


						$config['upload_path'] = 'assets/users';

						$config['allowed_types'] = 'jpg|jpeg|png|gif';

						$config['max_size'] = '5000';

						$config['client_name'] = $image_name;


						$this->load->library('upload', $config);


						if ($this->upload->do_upload('file')) {

							//echo "if";

							$uploadData = $this->upload->data();

							/* echo "<pre>";

							 print_r($uploadData);exit();*/

							$filename = $uploadData['client_name'];

							$data1['totalFiles'][] = $filename;

						}

					}

				}

				if ($_FILES['tbl_business_details_business_doc']['name'] != "") {

					$image_replace = str_replace(" ", "_", $_FILES['tbl_business_details_business_doc']['name']);

					$image_name = "business_doc_photo_" . $randomid . "_" . $image_replace;

					$images = array(

						'tbl_business_details_business_doc' => $image_name,

					);

					$this->Smme_User_model->image_insert($images, $upd_id, 'tbl_business_details', 'tbl_business_details_user_id');


					if (!empty($_FILES['tbl_business_details_business_doc']['name'])) {


						$_FILES['file']['name'] = $image_name;

						$_FILES['file']['type'] = $_FILES['tbl_business_details_business_doc']['type'];

						$_FILES['file']['tmp_name'] = $_FILES['tbl_business_details_business_doc']['tmp_name'];

						$_FILES['file']['error'] = $_FILES['tbl_business_details_business_doc']['error'];

						$_FILES['file']['size'] = $_FILES['tbl_business_details_business_doc']['size'];


						$config['upload_path'] = 'assets/users';

						$config['allowed_types'] = 'jpg|jpeg|png|gif';

						$config['max_size'] = '5000';

						$config['client_name'] = $image_name;


						$this->load->library('upload', $config);


						if ($this->upload->do_upload('file')) {

							//echo "if";

							$uploadData = $this->upload->data();

							/* echo "<pre>";

							 print_r($uploadData);exit();*/

							$filename = $uploadData['client_name'];

							$data1['totalFiles'][] = $filename;

						}

					}

				}

				$this->session->set_flashdata('success', 'Data Inserted Successfully!');

				redirect($_SERVER['HTTP_REFERER']);

			}

			if ($result == 2) {

				$this->session->set_flashdata('danger', 'Username or Email id is Duplicate!');

				redirect($_SERVER['HTTP_REFERER']);

			} elseif ($result == 0) {

				$this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');

				redirect($_SERVER['HTTP_REFERER']);

			}

		}

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);


		//$this->load->view ('home', $data);

		$this->load->view('admin/smme/index', $data);

		//print_r($_POST);exit;


	}


	public function delete($i)
	{

		//print_r($i);exit;


		$result = $this->Smme_User_model->did_delete_company_row($i);

		if ($result == 1) {

			$this->session->set_flashdata('success', 'Data Delete Successfully!');

			redirect('admin/smme');

		} elseif ($result == 0) {

			$this->session->set_flashdata('danger', 'We are in truble Data Could not Delete!');

			redirect('admin/smme');

		}

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);


		//$this->load->view ('home', $data);

		$this->load->view('admin/smme/index', $data);


	}


	public function get_state_by_zone()
	{


		$zone_id = $this->input->post('zone_id');

		$data = $this->Smme_User_model->get_state_by_zone($zone_id)->result();

		echo json_encode($data);

	}


	public function get_city_by_state()
	{


		$state_id = $this->input->post('state_id');

		$data = $this->Smme_User_model->get_city_by_state($state_id)->result();

		echo json_encode($data);

	}


	public function get_zip_by_city()
	{


		$city_id = $this->input->post('city_id');

		$data = $this->Smme_User_model->get_zip_by_city($city_id)->result();

		echo json_encode($data);

	}


	public function check_username()
	{


		$username = $this->input->post('username');

		$id = $this->input->post('id');

		$data = $this->Smme_User_model->check_username($username, $id);

		echo json_encode($data);

	}


	public function check_email()
	{


		$email = $this->input->post('email');

		$id = $this->input->post('id');

		$data = $this->Smme_User_model->check_email($email, $id);

		echo json_encode($data);

	}


	public function logout()
	{

		$data = ['id_user', 'username'];

		$this->session->unset_userdata($data);


		redirect('admin/masterlogin');

	}

	public function deleteBoard()
	{
		$id = trim($_POST['boardId']);
		$this->db->where("tbl_board_title", $id);
		$this->db->delete("tbl_board");
	}

}
