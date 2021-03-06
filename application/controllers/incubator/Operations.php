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
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
		$this->load->model("Home_modal");
		$this->load->database();
		$this->load->helper('email_service');
	}

	public function index()
	{
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		// $this->db->select("tbl_application_bdsp_id as id");
		// $this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
		// $query = $this->db->get('tbl_application');
		// $bdsps = $query->result();

		$sql = "select DISTINCT bdsp_id from tbl_application_assignment where app_id in 
			(SELECT app_id FROM tbl_application_assignment WHERE incubator_id=". $this->session->userdata("id_user") .
		    ") and bdsp_id is not null";
		// var_dump($query);
		// $this->db->select("bdsp_id as id");
		// $this->db->where("incubator_id", $this->session->userdata("id_user"));
		// $query = $this->db->get('tbl_application_assignment');
		$bdsps2 = $this->db->query($sql)->result();

		// $all = array_merge($bdsps, $bdsps2);
		// to remove duplicates in $all
		$all = array_unique($bdsps2, SORT_REGULAR);

		foreach ($all as $bdsp) {
			$this->db->select("*");
			$this->db->where("tbl_users_id", $bdsp->bdsp_id);
			$query = $this->db->get("tbl_users");
			$data['bdsps'][] = $query->result();
		}

		$this->load->view('incubator/assigned-bdsp', $data);
	}

	public function incprogress($smmeid) {
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

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
        $this->load->view('incubator/smme/incubation_progress', $data);

	}

	 public function incubationstatus()
    {
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$smmeIds = $this->_get_assigned_smme();

		// to remove duplicates in $all
		$all = array_unique($smmeIds, SORT_REGULAR);

        $data['phases'] = [];

        $this->db->select("*");
        $phases = $this->db->get("tbl_phase")->result();
        $data['phases'] = $phases;
        // print_r($all);exit();
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
	    // print_r($periodProgress);exit();
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

	    // print_r($data['Investigation']['smmes']);exit();
	    
		$this->load->view('incubator/incubation_status', $data);
    }

    function _get_assigned_smme() {
		$this->db->join('tbl_application','tbl_application.tbl_application_id = tbl_application_assignment.app_id','LEFT');
    	$this->db->select("smme_id as id, app_id, tbl_application.tbl_application_status");
		$this->db->where("incubator_id", $this->session->userdata("id_user"));
		$query = $this->db->get('tbl_application_assignment');
		return $query->result();
    }
	function select_user_business_data($id) {
    	
    	$this->db->join('tbl_industry','tbl_industry.tbl_industry_id = tbl_business_details.tbl_business_details_industry','LEFT');

        $this->db->join('tbl_sub_industry','tbl_sub_industry.tbl_sub_industry_id = tbl_business_details.tbl_business_details_sub_industry','LEFT');

        $this->db->where('tbl_business_details_user_id',$id);
        $query=$this->db->get('tbl_business_details');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
        
    }
	
	public function allbdsp()
    {
		
		$this->db->where('tbl_roles_title', 'BDSP');
        $querys=$this->db->get('tbl_roles');
        $results=$querys->result();

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_users_role_id', $results[0]->tbl_roles_id);
        $this->db->group_by('tbl_users_id');
        $query=$this->db->get('tbl_users');
        $result=$query->result();   
		$data['tdata'] = $result;
		$result3=[];
		foreach ($result as $res){
			$id=$res->tbl_users_id;
			$result2=$this->select_user_business_data($id);
			if(!empty($result2)){
				foreach($result2 as $res3){
					 $tbl_industry_name3=$res3->tbl_industry_name;
				}
			}else{
				$tbl_industry_name3="";
			}
			$result3[] = (object)["tbl_industry_name" => $tbl_industry_name3];
		}
       
 		$data['businessdata']=$result3;
		
        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE); 
		$this->load->view('incubator/allbdsp', $data);
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

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

        $this->load->view('incubator/viewdetails',$data);
    }
	
	public function assignedtosmme($id)
    {
    	$smmes2 = $this->_get_assigned_smme();
		$all = array_unique($smmes2, SORT_REGULAR);
		$dataUser = [];
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
					$dataUser[] = $user[0];
				}
			}
		}
		$data['tdata'] = $dataUser;

  		$this->db->where('tbl_users_id', $id);
		$query=$this->db->get('tbl_users');
		$result2=$query->result(); 
		$data['bdspdata'] = $result2;

		// $this->db->where('tbl_roles_title', 'MSME');
  //       $querys=$this->db->get('tbl_roles');
  //       $results=$querys->result();
       	
  //       $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
  //       $this->db->where('tbl_users_role_id', $results[0]->tbl_roles_id);
  //       $this->db->group_by('tbl_users_id');
  //       $query=$this->db->get('tbl_users');
  //       $result=$query->result();

        $data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE); 
		$this->load->view('incubator/assignedtosmme', $data);
    }

    


	public function indexsmme()
	{
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		// $this->db->select("tbl_application_smme_id as id");
		// $this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
		// $query = $this->db->get('tbl_application');
		// $smmes = $query->result();

		$smmes2 = $this->_get_assigned_smme();
		// $all = array_merge($smmes, $smmes2);
		// to remove duplicates in $all
		$all = array_unique($smmes2, SORT_REGULAR);
		

		foreach ($all as $smme) {
			if($smme->tbl_application_status == "Declined" || $smme->tbl_application_status == "")
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
				}
				
				$data['smmes'][] = $user;
			}
		}
		
		//echo '<pre>';print_r($data['smmes']); exit;

		$this->db->select("*");
		$data['stages'] = $this->db->get("tbl_stages")->result();

		$this->load->view('incubator/assigned-smme', $data);
	}

	public function UpdateAssignedSmme($bdsp)
	{
		if($_POST)
        {
			$now = date("Y-m-d H:i:s");
			$smmeid=$this->input->post('stage');
            if($smmeid==""){
				$this->session->set_flashdata("danger","Please select MSME"); 
                      redirect('incubator/Operations/assignedtosmme/'.$bdsp);
			}else{					 
			    $this->db->select("*");
				$this->db->where("smme_id", $smmeid);
				$this->db->where("bdsp_id", $bdsp);
				$query = $this->db->get("tbl_application_assignment");
				if($query->num_rows()>0){
					  $this->session->set_flashdata("success","Already Assigned To MSME"); 
                      redirect('incubator/Operations/assignedtosmme/'.$bdsp);
				}else{			   
					$newdata = array(	
					'smme_id' => $smmeid,
					'app_id'=>0,
					'incubator_id' => null,
					'bdsp_id' => $bdsp,
					); 
					$this->db->insert('tbl_application_assignment', $newdata);
					//notify bdsp that msme assign to him
					$user = $this->db->where('tbl_users_id',$bdsp)->get('tbl_users')->row();
					$owner = $this->db->where('tbl_users_id',$this->session->userdata('id_user'))->get('tbl_users')->row();
					$process_key = "smme_assigned_bdsp";
					$emailData = $this->db->where('process_key',$process_key)->get('tbl_emails')->row();
					$data['title'] = $emailData->subject;
			        $keys = [
			        		'[name_to]' => $user->tbl_users_firstname .' ' . $user->tbl_users_lastname,
			        		'[name_from]' => $owner->tbl_users_firstname .' ' . $owner->tbl_users_lastname,
			        	];
			       	$content = do_shortcodes($emailData->message,$keys);
			        email_send($user->tbl_users_email,$emailData->subject,$emailData->subject,$content);
			        email_logs($user->tbl_users_id,$emailData->subject);
			        //end

			        //notify msme that bdsp assigned to him
			        
			        $user2 = $this->db->where('tbl_users_id',$smmeid)->get('tbl_users')->row();
					$owner2 = $this->db->where('tbl_users_id',$this->session->userdata('id_user'))->get('tbl_users')->row();
					$process_key2 = "msme_notify_bsdp_assigned";
					$emailData2 = $this->db->where('process_key',$process_key2)->get('tbl_emails')->row();
			        $keys2 = [
			        		'[name_to]' => $user2->tbl_users_firstname .' ' . $user2->tbl_users_lastname,
			        		'[name_from]' => $owner2->tbl_users_firstname .' ' . $owner2->tbl_users_lastname,
			        	];
			       	$content2 = do_shortcodes($emailData2->message,$keys2);
			        email_send($user->tbl_users_email,$emailData2->subject,$emailData2->subject,$content2);
			        email_logs($user->tbl_users_id,$emailData2->subject);
			        //end
					$this->session->set_flashdata("success","Assigned To MSME Successfully"); 

                    redirect('incubator/Operations/assignedtosmme/'.$bdsp);
				}
			}
		}	
		
		
	}
	
	
	public function changeStatus()
	{
		$this->db->where("tbl_users_id", $this->input->post("id"));
		$this->db->update("tbl_users", [
			"tbl_users_status" => (string)$this->input->post("stage_id")
		]);
		
		$this->db->where("tbl_application_id", $this->input->post("app_id"));
		$this->db->update("tbl_application", [
			"tbl_application_status" => (string)$this->input->post("status")
		]);
		
		$data['app'] = $this->db->where("tbl_application_id", $this->input->post("app_id"))->get('tbl_application')->result();
		$data['status'] = $this->input->post("status");

		$user = $this->db->where('tbl_users_id',$this->input->post("id"))->get('tbl_users')->row();
		$owner = $this->db->where('tbl_users_id',$this->session->userdata('id_user'))->get('tbl_users')->row();
		$process_key = "incubation_status_changed";
		$emailData = $this->db->where('process_key',$process_key)->get('tbl_emails')->row();
		$data['title'] = $emailData->subject;
        $keys = [
        		'[name_to]' => $user->tbl_users_firstname .' ' . $user->tbl_users_lastname,
        		'[name_from]' => $owner->tbl_users_firstname .' ' . $owner->tbl_users_lastname,
        	];
       	$content = do_shortcodes($emailData->message,$keys);
        echo email_send($user->tbl_users_email,$emailData->subject,$emailData->subject,$content);
        email_logs($user->tbl_users_id,$emailData->subject); 
	}

	public function logout()
	{
		$data = ['id_user', 'username', 'user_profile_image', 'user_type', 'user_type_name', 'user_unique_id', 'user_email'];
		$this->session->unset_userdata($data);
		redirect('Login');

	}
}
