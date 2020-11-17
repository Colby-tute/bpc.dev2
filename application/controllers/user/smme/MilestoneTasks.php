	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');
class MilestoneTasks extends MY_Controller
{

	function __construct() {
		parent::__construct();

		if(empty($this->session->userdata('id_user'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('Login');
		}
		$this->load->database();
		$this->load->helper('email_service');
	}

	public function index()
	{
		//Change this to enable MilestoneTasks logic
		$flow="milestonequestions";
		$smme_id = $this->session->userdata("id_user");

		if($flow == "milestonequestions") {
			$this->db->select('*');
			$this->db->where('smme_id', $smme_id);
			$this->db->order_by('task_target_date DESC');
			$query = $this->db->get("tbl_smme_milestone_tasks");
			$data['milestones'] = $query->result();
		} else {
			$this->db->select('*');
			$this->db->where('smme_id', $smme_id);
			$this->db->order_by('target_date DESC');
			$query = $this->db->get("tbl_smme_question_answer");
			$data['milestones'] = $query->result();			
		}

		$this->db->select("*");
		$query = $this->db->get("tbl_phase");
		$data['phases'] = $query->result();
			$this->db->select("*");
		$query = $this->db->get("tbl_sub_phase");
		$data['subphases'] = $query->result();

		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$data['smme_id'] = $smme_id;

		//$this->load->view('user/smme/milestonetasks/index',$data);
		$this->load->view('user/smme/milestonequestions/index',$data);
	}

	public function processMilestoneTasks($id) {

		//Change this to enable MilestoneTasks logic
		$flow="milestonequestions";

		if($flow == "milestonequestions") {
			$taskAction = $_POST['taskAction'];
			if($taskAction == "getMilestoneTasks") {
				$phaseId = $_POST['phaseId'];
				$subPhaseId = $_POST['subPhaseId'];
				$smmeId = $_POST['smmeId'];

				$this->db->select("*");
				$this->db->where('phase_id', $phaseId);
				$this->db->where('subphase_id', $subPhaseId);
				$this->db->where('user_id', $smmeId);	
				$this->db->where('is_deleted', false);
				$query = $this->db->get("tbl_smme_question_answer");
				$data['tasks'] = $query->result();
				echo json_encode($data);

			} else if($taskAction == "completeMilestoneTask") {
				$taskId = $_POST['taskId'];
				$this->db->where("id", $taskId);
				$this->db->update("tbl_smme_question_answer", [
					"is_answered" => true,
					"completion_date" => date("Y-m-d")
				]);
				if($this->bbmprogress($_POST['smmeId']) == 100){
					$user = $this->db->where('tbl_users_id',$_POST['smmeId'])->get('tbl_users')->row();
					$owner = $this->db->where('tbl_users_id',$this->session->userdata('id_user'))->get('tbl_users')->row();
					$process_key = "business_smme_completed";
					$emailData = $this->db->where('process_key',$process_key)->get('tbl_emails')->row();
					$data['title'] = $emailData->subject;
			        $keys = [
			        		'[name_to]' => $user->tbl_users_firstname .' ' . $user->tbl_users_lastname,
			        		'[name_from]' => $owner->tbl_users_firstname .' ' . $owner->tbl_users_lastname,
			        	];
			       	$content = do_shortcodes($emailData->message,$keys);
			        email_send($user->tbl_users_email,$emailData->subject,$emailData->subject,$content);
			        email_logs($user->tbl_users_id,$emailData->subject);
				}
			} else if($taskAction == "getAllMilestoneTasks") {
				$smmeId = $_POST['smmeId'];

				$this->db->select("*");
				$this->db->where('user_id', $smmeId);	
				$this->db->where('is_deleted', false);
				$this->db->where('is_answered', false);
				$this->db->order_by('target_date','ASC');
				$query = $this->db->get("tbl_smme_question_answer");
				$data['task_notifications'] = $query->result();
				echo json_encode($data);
			} else {

			}
		} else {
			//Milestone Tasks Logic
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

			} else if($taskAction == "completeMilestoneTask") {
				$taskId = $_POST['taskId'];
				$this->db->where("id", $taskId);
				$this->db->update("tbl_smme_milestone_tasks", [
					"task_status" => "Y"
				]);

			} else if($taskAction == "getAllMilestoneTasks") {
				$smmeId = $_POST['smmeId'];

				$this->db->select("*");
				$this->db->where('smme_id', $smmeId);	
				$this->db->where('task_status', "N");
				$this->db->order_by('task_target_date','ASC');
				$query = $this->db->get("tbl_smme_milestone_tasks");
				$data['task_notifications'] = $query->result();
				echo json_encode($data);
			} else {

			}			
		}
	}

	public function bbmprogress($smmeid) {

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

    public function processQuestions($smmeId) {
        $questionAction = $_POST['questionAction'];
		if($questionAction == "getAllQuestions") {

			$this->db->select("*");
			$this->db->where('user_id', $smmeId);	
			$this->db->where('is_answered', false);
			$this->db->where('is_deleted', false);
			$this->db->order_by('target_date', 'asc');
			$query = $this->db->get("tbl_smme_question_answer");
			$data['task_notifications'] = $query->result();
			echo json_encode($data);
		} else {

        }
    }  
}
