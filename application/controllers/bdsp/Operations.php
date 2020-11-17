<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Operations extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("Home_modal");
		$this->load->database();
	}

	public function index()
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
			$this->db->select("*");
			$this->db->where("tbl_users_id", $smme->id);
			//$this->db->where_in("tbl_users_status", array(4, 6, 7));
			$query = $this->db->get("tbl_users");
			$data['smmes'][] = $query->result();
		}
		$this->load->view('bdsp/assigned-smme', $data);
	}

	public function incprogress($smmeid) {
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

		$data['phases'] = [];

        $this->db->select("*");
        $phases = $this->db->get("tbl_phase")->result_array();
        $data['phases'] = $phases;

        $this->db->where('tbl_users_id', $smmeid);
        $smme = $this->db->get('tbl_users')->result();
        $data['smme'] = $smme;

        // print_r($data['smme']);exit();

        $this->db->select("*");
        $sub_phases = $this->db->get("tbl_sub_phase")->result();
        $data['sub_phases'] = $sub_phases;

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
        $this->load->view('bdsp/smme/incubation_progress', $data);

	}

    public function incubationstatus()
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

        $data['phases'] = [];

        $this->db->select("*");
        $phases = $this->db->get("tbl_phase")->result();
        $data['phases'] = $phases;

        $smmePhasePercentage = [];
		foreach ($all as $smme) {
			$phasePercentage = [];
	        foreach ($data['phases'] as $phase) {
	            $phasePercentage[] = [
	                'phase' => $phase->phase,
	                'phaseName' => str_replace(" ", "", $phase->phase),
	                'phaseId' => $phase->id,
	                'percent' => 0
	            ];
	        }

	        $user_id = $this->session->userdata("id_user");

	        $this->db->select("phase_id, subphase_id,COUNT(id) as answered_count");
	        $this->db->where("user_id", $smme->id);
	        $this->db->where("is_answered", true);
	        $this->db->where("is_deleted", false);
	        $this->db->group_by('phase_id');
	        $this->db->group_by('subphase_id');
	        $answered = $this->db->get("tbl_smme_question_answer")->result();

	        $this->db->select("phase_id, subphase_id,COUNT(id) as total_count");
	        $this->db->where("user_id", $smme->id);
	        $this->db->where("is_deleted", false);
	        $this->db->group_by('phase_id');
	        $this->db->group_by('subphase_id');
	        $questions = $this->db->get("tbl_smme_question_answer")->result();

	        foreach ($questions as $question) {
	            foreach ($answered as $answer) {
	                if($question->phase_id == $answer->phase_id && $question->subphase_id == $answer->subphase_id) {
	                    if($question->total_count == $answer->answered_count) {
	                        $phasePercentage[$question->phase_id-1]['percent'] += 25;
	                    }
	                    break;
	                }
	            }
	        }
	        $smmePhasePercentage[$smme->id] = $phasePercentage;
	    }

	    $periodProgress = [
	    	"Investigation" => [],
	    	"Development" => [],
	    	"Commercial" => []
	    ];

	    foreach ($smmePhasePercentage as $smmeId => $phasesPercentage) {
			if($smmePhasePercentage[$smmeId][0]["percent"] != 100) {
				array_push($periodProgress["Investigation"],$smmeId);
			}
			else if($smmePhasePercentage[$smmeId][1]["percent"] != 100 || $smmePhasePercentage[$smmeId][2]["percent"] != 100 ||
					$smmePhasePercentage[3]["percent"] != 100) {
				array_push($periodProgress["Development"],$smmeId);
			}
			else if($smmePhasePercentage[$smmeId][4]["percent"] != 100 || $smmePhasePercentage[$smmeId][5]["percent"] != 100) {
				array_push($periodProgress["Commercial"],$smmeId);
			}
	    }

	    foreach ($periodProgress as $period => $smmeIds) {
	    	if(empty($smmeIds)) {
	    		$data[$period]['smmes'][] = [];
	    	} else {
				$this->db->select("*");
				$this->db->where_in("tbl_users_id", $smmeIds);
				$query = $this->db->get("tbl_users");
				$data[$period]['smmes'][] = $query->result();
			}
	    }
	    
		$this->load->view('bdsp/incubation_status', $data);
    }
    
	public function evaluateIncubator($id, $name = false)
	{
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		if ($this->input->server("REQUEST_METHOD") == "POST") {
			$this->db->insert("tbl_evaluate_bdsp_inc", $_POST);
			redirect("bdsp/Operations/indexinc");
		}
		$data['name'] = $name;
		$data['id'] = $id;
		$this->load->view("bdsp/smme/evaluateIncubator", $data);
	}

	public function indexinc()
	{
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

		$this->db->distinct("tbl_application_incubator_id as id");
		$this->db->select("tbl_application_incubator_id as id, incubator_id");
		$this->db->join("tbl_application_assignment as aa", "tbl_application.tbl_application_id=aa.app_id", "LEFT");
		$this->db->where("tbl_application_bdsp_id='{$this->session->userdata('id_user')}'");
		$this->db->where("aa.incubator_id IS NOT NULL");
		$query = $this->db->get("tbl_application");
		$incubators = $query->result();

		foreach ($incubators as $pair) {
			$this->db->select("*");
			$this->db->where("tbl_users_id = '{$pair->id}' OR tbl_users_id='{$pair->incubator_id}'");
			$query = $this->db->get("tbl_users");
			$users = $query->result();
			$data['incubators'][] = $users;
		}

		$this->load->view('bdsp/assigned-inc', $data);
	}
	
	
	 public function viewdetails($id) {

        $this->db->where('tbl_personal_details_user_id',$id);
        $query=$this->db->get('tbl_personal_details');
        $personal=$query->result();
		$data['personal'] = $personal;
		
      //  $userdt = $this->Bdsp_Modal->select_user_data($id);
        $this->db->join('tbl_stages as s','s.id = u.tbl_users_status','LEFT');
        $this->db->where('tbl_users_id',$id);
        $this->db->select('s.stage,u.*' );
        $query=$this->db->get('tbl_users as u');
        $userdt=$query->result();
		$data['userdt'] = $userdt;

      	$this->db->join('tbl_industry','tbl_industry.tbl_industry_id = tbl_business_details.tbl_business_details_industry','LEFT');
        $this->db->join('tbl_sub_industry','tbl_sub_industry.tbl_sub_industry_id = tbl_business_details.tbl_business_details_sub_industry','LEFT');
        $this->db->where('tbl_business_details_user_id',$id);
        $query=$this->db->get('tbl_business_details');
        $business=$query->result();
		$data['business'] = $business;
		
		   $this->db->where("tbl_all_documents_user_id", $id);
				$this->db->where("tbl_all_documents_type","B");
$this->db->where("upload_for",0);
				$query2 = $this->db->get("tbl_all_documents");
				$businessdoc=$query2->result();
				$data['business_doc']=$businessdoc;

         $this->db->where('tbl_smme_teams_user_id',$id);
        $query=$this->db->get('tbl_smme_teams');
        $smme_teams=$query->result();
		$data['smme_teams'] = $smme_teams;

        $this->db->select("*");
        $this->db->where("user_id", $id);
        $data['partners'] = $this->db->get("tbl_user_partner")->result();

        $data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

        $this->load->view('bdsp/viewdetails',$data);
    }
	

	public function logout()
	{
		$data = ['id_user', 'username', 'user_profile_image', 'user_type', 'user_type_name', 'user_unique_id', 'user_email'];
		$this->session->unset_userdata($data);
		redirect('Login');

	}
}
