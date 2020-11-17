<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');
class Analytics extends MY_Controller
{

	function __construct() {
		parent::__construct();
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'Please login');
            redirect('Login');
        }		
		$this->load->database();
		$this->load->model("smme/Analytics_model");
	}

	public function evaluationReport() {

		$data['smmes'] = json_encode($this->Analytics_model->get_all_smmes());
		$data['incubators'] = json_encode($this->Analytics_model->get_all_users_by_role(3));
		$data['bdsps'] = json_encode($this->Analytics_model->get_all_users_by_role(4));

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$this->load->view('user/smme/analytics/evaluation',$data);
	}

	public function getUserEvaluationReport() {
		$evaluatee_type = $_POST['userType'];
		$evaluatee_id = $_POST['userId'];
		$data = [];
		if($evaluatee_type == "MSME") {
			$data = json_encode($this->Analytics_model->get_smme_ratings($evaluatee_id));
		} else if($evaluatee_type == "Incubator") {
			$data = json_encode($this->Analytics_model->get_incubator_ratings($evaluatee_id));
		} else if($evaluatee_type == "BDSP") {
			$data = json_encode($this->Analytics_model->get_bdsp_ratings($evaluatee_id));
		}
		echo $data;
	}
	
	public function incubationProgressReport() {
		$incubationProgress = array(
								'Investigation' => 0,
								'Development' => 0,
								'Commercial' => 0 );
		$statuses = $this->Analytics_model->get_smme_incubation_progress();
		for($idx = 0; $idx < sizeof($statuses); $idx +=3) {
			if($statuses[$idx]['percentage'] != "100") {
				$incubationProgress['Investigation'] += 1;
			} else if($statuses[$idx+1]['percentage'] != "100") {
				$incubationProgress['Development'] += 1;
			} else if($statuses[$idx+2]['percentage'] != "100") {
				$incubationProgress['Commercial'] += 1;
			}
		}
		$data['incubationProgress'] = json_encode($incubationProgress);
		
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$this->load->view('user/smme/analytics/incubationprogress',$data);
	}

	public function securityReport() {

		$data['results'] = json_encode($this->Analytics_model->get_users_by_login_result());
		$data['browsers'] = json_encode($this->Analytics_model->get_users_by_browsers());
		$data['countries'] = json_encode($this->Analytics_model->get_users_by_country());

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$this->load->view('user/smme/analytics/security',$data);
	}

	public function incprogress() {
		$smmeid = $this->session->userdata('id_user');
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$data['phases'] = [];

        $this->db->select("*");
        $phases = $this->db->get("tbl_phase")->result_array();
        $data['phases'] = $phases;

        $this->db->select("*");
        $sub_phases = $this->db->get("tbl_sub_phase")->result();
        $data['sub_phases'] = $sub_phases;

        
        $this->db->where('tbl_users_id', $smmeid);
        $smme = $this->db->get('tbl_users')->result();
        $data['smme'] = $smme;

        $PhaseSubPhasePercentage = [];
        foreach ($phases as $phase) {
        	$subPhasePercentage = [];
        	foreach ($data['sub_phases'] as $sub_phase) {
	            $subPhasePercentage[] = [
	                'subphaseName' => $sub_phase->phase,
	                'subphaseId' => $sub_phase->id,
	                'percent' => 0,
	                'color' => '#ff8080',
	                'textColor' => '',
	                'statusText' => 'Incomplete'
	            ];
	        }
	        //answered count
	       	$this->db->select("subphase_id,COUNT(id) as answered_count");
	        $this->db->where("user_id", $smmeid);
	        $this->db->where("is_answered", true);
	        $this->db->where("is_deleted", false);
	        $this->db->where('phase_id', $phase['id']);
	        $this->db->group_by('subphase_id');
	        $answered = $this->db->get("tbl_smme_question_answer")->result();
	        //total questions
	       	$this->db->select("subphase_id,COUNT(id) as total_count");
	        $this->db->where("user_id", $smmeid);
	        $this->db->where("is_deleted", false);
	        $this->db->where('phase_id', $phase['id']);
	        $this->db->group_by('subphase_id');
	        $questions = $this->db->get("tbl_smme_question_answer")->result();

	        foreach ($questions as $question) {
	            foreach ($answered as $answer) {
	                if($question->subphase_id == $answer->subphase_id) {	           
	                    $subPhasePercentage[$question->subphase_id-1]['percent'] = round(($answer->answered_count / $question->total_count)*100,1);
	                    $percentage=$subPhasePercentage[$question->subphase_id-1]['percent'];
	                    $statusText = 'Incomplete';
	                    $textColor = '';

	                    if($percentage == 0) {
	                    	$color = "#ff8080";
	                    } else if($percentage > 0 && $percentage <= 25) {
	                    	$color = "#ffc966";
	                    } else if($percentage > 25 && $percentage <= 50) {
	                    	$color = "#ffffb3";
	                    	$textColor = "black";
	                    } else if($percentage > 50 && $percentage <= 75) {
	                    	$color = "#f8ffcc";
	                    	$textColor = "black";
	                    } else if($percentage > 75 && $percentage < 100) {
	                    	$color = "#e6ffcc";
	                    	$textColor = "black";
	                    } else if($percentage == 100) {
	                    	$color = "#008000";
	                    	$statusText = "Complete";
	                    }
	                    $subPhasePercentage[$question->subphase_id-1]['textColor'] = $textColor;
	                    $subPhasePercentage[$question->subphase_id-1]['color'] = $color;
	                    $subPhasePercentage[$question->subphase_id-1]['statusText'] = $statusText;
	                    break;
	                }
	            }

	        }

	        $PhaseSubPhasePercentage[$phase['id']-1] = $subPhasePercentage;

        }//end of phase foreach	

        $data['smmeid'] = $smmeid;
        $data['PhaseSubPhasePercentage'] = $PhaseSubPhasePercentage;
        $this->load->view('user/smme/analytics/incubation_progress_table', $data);

	}

}
