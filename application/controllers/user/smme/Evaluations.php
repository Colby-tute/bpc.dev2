<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Evaluations extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("smme/Evaluations_Model");
		$this->load->database();
		$this->load->helper("email_service");
	}

	public function index()
	{

		$applications = $this->Evaluations_Model->get_smme_applications($this->session->userdata("id_user"));
		// $data['applications'] = $applications;
		// $data['header'] = $this->load->view('includes/header', NULL, TRUE);
		// $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		// $this->load->view('user/smme/evaluations/applicationList', $data);
		$this->evaluateesList($applications[0]->app_id);
	}

	public function performEvaluation()
	{
		$app_id =  $this->uri->segment(5);
		$smme_id =  $this->uri->segment(6);
		$evaluatee_id =  $this->uri->segment(7);
		$evaluator_id = $this->session->userdata("id_user");
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$questions=$this->Evaluations_Model->get_evaluation_questions($evaluatee_id);
		$evaluatee_details = $this->Evaluations_Model->get_user_details($evaluatee_id)[0];
		$data['app_id'] = $app_id;
		$data['smme_id'] = $smme_id;
		$data['questions'] = $questions;
		$data['evaluatee_id'] = $evaluatee_id;
		$data['evaluator_id'] = $evaluator_id;
		$data['evaluatee_details'] = $evaluatee_details;

		$this->load->view('user/smme/evaluations/performEvaluation', $data);
	}

	public function evaluateesList($appid)
	{
		$application_assignments = $this->Evaluations_Model->get_smme_application($appid);
		$smmeid = $application_assignments[0]->smme_id;
		$evaluatees = [
		    'Incubator' => [],
		    'BDSP' => []
		];
		$evaluatee_details=[];	
		foreach ($application_assignments as $application) {
			$smme_id = $application->smme_id;
			$incubator_id = $application->incubator_id;
			$bdsp_id = $application->bdsp_id;
			if($incubator_id != NULL) {
				if(!in_array($incubator_id, $evaluatees['Incubator'])) {
					$incubator = $this->Evaluations_Model->get_user_details($incubator_id);
					// print_r($incubator);exit();
					if(!empty($incubator)){
						array_push($evaluatees['Incubator'], $incubator_id);
						$evaluatee_details[$incubator_id] = $incubator;
					}
				}
			}
			if($bdsp_id != NULL) {
				if(!in_array($smme_id, $evaluatees['BDSP'])) {
					// $smmeid = $bdsp_id;
					$bdsp = $this->Evaluations_Model->get_user_details($bdsp_id);
					// print_r($smme);exit();
					if(!empty($bdsp)){
						array_push($evaluatees['BDSP'], $bdsp_id);
						$evaluatee_details[$bdsp_id] = $bdsp;
					}
				}
			}
		}
		$data['smme_id'] = $smmeid;
		$data['evaluatees_list'] = $evaluatees;
		$data['evaluatee_details'] = $evaluatee_details;
		// print_r($evaluatee_details);exit();
		$data['app_id'] = $appid;
		$data['evaluator_id'] = $this->session->userdata("id_user");
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$this->load->view('user/smme/evaluations/evaluateesList', $data);
	}

	public function submitEvaluation()
	{
		$evaluation = $this->input->post('evaluation');		
		$evaluation_title=$evaluation['title'];		
		$evaluation_appid=$evaluation['smme_application_id'];
		$evaluation_smmeid=$evaluation['smme_id'];
		$evaluation_evaid=$evaluation['evaluator_id'];
		$evaluatee_id = $evaluation['evaluatee_id'];
		if(strlen($evaluation_title)==0){
			 $this->session->set_flashdata('danger', 'Please Fill Evaluation Title');
             redirect("user/smme/Evaluations/performEvaluation/".$evaluation_appid."/".$evaluation_smmeid."/".$evaluatee_id);
		}
		
		$evaluation_id = $this->Evaluations_Model->create_evaluation($evaluation);
		if($evaluation_id){
			$this->Evaluations_Model->submit_evaluation_answers($evaluation, $evaluation_id);
	       	$user = $this->db->where('tbl_users_id',$evaluation_evaid)->get('tbl_users')->row();
	       	$owner = $this->db->where('tbl_users_id',$this->session->userdata('id_user'))->get('tbl_users')->row();
			//mail created
			$keys = [
	        		'[name_to]' => $user->tbl_users_firstname .' ' . $user->tbl_users_lastname,
	        		'[name_from]' => $owner->tbl_users_firstname .' ' . $owner->tbl_users_lastname,
	        	];
			$process_key = "new_evaluation_created";
			$emailData = $this->db->where('process_key',$process_key)->get('tbl_emails')->row();
	       	$content = do_shortcodes($emailData->message,$keys);
	        email_send($user->tbl_users_email,$emailData->subject,$emailData->subject,$content);
	        email_logs($user->tbl_users_id,$emailData->subject);

	        //mail2 details
			$process_key2 = "new_evaluation_details";
			$emailData2 = $this->db->where('process_key',$process_key2)->get('tbl_emails')->row();
	       	$content2 = do_shortcodes($emailData2->message,$keys);
	        email_send($user->tbl_users_email,$emailData2->subject,$emailData2->subject,$content2);
	        email_logs($user->tbl_users_id,$emailData2->subject);
	        //end
        }
		redirect('user/smme/Evaluations/viewEvaluations', 'location');
	}

	public function viewEvaluations()
	{
		$evaluator_id = $this->session->userdata("id_user");
		$evaluations = $this->Evaluations_Model->get_evaluations($evaluator_id);
		$data['evaluations'] = $evaluations;
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$this->load->view('user/smme/evaluations/viewEvaluations', $data);
	}

	public function viewEvaluation()
	{
		$evaluation_id =  $this->uri->segment(5);
		$evaluatee_id =  $this->uri->segment(6);
		// print_r($evaluation_id.' / '.$evaluatee_id);exit();
		$evaluation_details = $this->Evaluations_Model->get_evaluation($evaluation_id);
		$data['evaluation_details'] = $evaluation_details[0];

		$evaluation = $this->Evaluations_Model->get_evaluation_answers($evaluation_id);
		$data['evaluator_id'] = $this->session->userdata("id_user");
		$data['evaluatee_id'] = $evaluatee_id;
		$data['evaluation'] = $evaluation;
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$this->load->view('user/smme/evaluations/viewEvaluation', $data);
	}
}
