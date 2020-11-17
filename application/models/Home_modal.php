<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name: Login model
 * @author: Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Home_modal extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function select_profile_image()
	{
		$this->db->where('tbl_users_id', $this->session->userdata('id_user'));
		$this->db->select('tbl_users_photo');
		$query = $this->db->get('tbl_users');
		$result = $query->result();
		return $result;
	}

	public function check_user($user_type)
	{

		$this->db->where('tbl_roles_id', $user_type);
		$query = $this->db->get('tbl_roles');
		$result = $query->result();
		//print_r($result);exit();
		return $result;
	}

	public function get_data($session_id)
	{
		$this->db->where('tbl_users_id', $session_id);
		$query = $this->db->get('tbl_users');
		$result = $query->result();
		return $result;
	}

	public function total_count_team($session_id)
	{
		$this->db->where('tbl_smme_teams_user_id', $session_id);
		$query = $this->db->get('tbl_smme_teams');
		$result = $query->result();
		$num_rows = $query->num_rows();
		return array('total_rows' => $num_rows, 'result' => $result);
	}

	public function application_status($session_id)
	{
		$this->db->order_by('tbl_application_smme_id');
		$this->db->where('tbl_application_smme_id', $session_id);
		$query = $this->db->get('tbl_application');
		$result = $query->result();
		return $result;
	}

	public function incubators_count()
	{
		$this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id', 'LEFT');
		$this->db->where('tbl_roles.tbl_roles_title', 'INCUBATOR');
		$query = $this->db->get('tbl_users');
		$result = $query->result();
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	public function incubators_count1()
	{
		$this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id', 'LEFT');
		$this->db->where('tbl_roles.tbl_roles_title', 'BDSP');
		$query = $this->db->get('tbl_users');
		$result = $query->result();
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	public function incubators_register_date()
	{

		$this->db->order_by('tbl_users.tbl_users_id');
		$this->db->limit(1);
		$this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id', 'LEFT');
		$this->db->where('tbl_roles.tbl_roles_title', 'INCUBATOR');
		$this->db->select('tbl_users.tbl_users_insertdate');
		$query = $this->db->get('tbl_users');
		$result = $query->result();
		return $result;
	}

	public function login_history($id)
	{
		$this->db->where('tbl_login_history_user_id', $id);
		$this->db->order_by('tbl_login_history_id', 'DESC');
		$query = $this->db->get('tbl_login_history');
		$result = $query->result();
		//print_r($result);exit();
		return $result;
	}

	public function personal_todo($unique_id)
	{
		$this->db->where('tbl_personal_todos_user_id', $unique_id);
		//$this->db->order_by('tbl_login_history_id','DESC');
		$query = $this->db->get('tbl_personal_todos');
		$result = $query->result();
		return $result;
	}

	public function persoanl_details($id)
	{
		$this->db->join('tbl_personal_details', 'tbl_personal_details.tbl_personal_details_user_id = tbl_users.tbl_users_id', 'LEFT');
		$this->db->join('tbl_all_documents', 'tbl_all_documents.tbl_all_documents_user_id = tbl_users.tbl_users_id', 'LEFT');
		$this->db->where('tbl_users.tbl_users_id', $id);
		$this->db->select('tbl_users.tbl_users_firstname,tbl_users.tbl_users_lastname,tbl_users.tbl_users_email,tbl_users.tbl_users_mobile,tbl_users.tbl_users_gender,tbl_users.tbl_users_photo,tbl_personal_details.tbl_personal_details_occupation,tbl_personal_details.tbl_personal_details_dob,tbl_personal_details.tbl_personal_details_optional_telephone,tbl_personal_details.tbl_personal_details_district,tbl_personal_details.tbl_personal_details_town_village,tbl_personal_details.tbl_personal_details_postcode,tbl_personal_details.tbl_personal_details_education,tbl_personal_details.tbl_personal_details_howdidyouknow,(SELECT COUNT(*) FROM tbl_all_documents WHERE tbl_all_documents.tbl_all_documents_user_id = ' . $id . ' AND tbl_all_documents.tbl_all_documents_type = "I") AS idoc,(SELECT COUNT(*) FROM tbl_all_documents WHERE tbl_all_documents.tbl_all_documents_user_id = ' . $id . ' AND tbl_all_documents.tbl_all_documents_type = "E") AS edoc');
		$this->db->group_by('tbl_users.tbl_users_id');
		$query = $this->db->get('tbl_users');
		$result = $query->result();
		return $result;
	}

	public function business_details($id)
	{
		$this->db->join('tbl_all_documents', 'tbl_all_documents.tbl_all_documents_user_id = tbl_business_details.tbl_business_details_user_id', 'LEFT');
		//$this->db->where('tbl_all_documents.tbl_all_documents_type','B');
		$this->db->where('tbl_business_details.tbl_business_details_user_id', $id);
		$this->db->select('tbl_business_details.tbl_business_details_name,tbl_business_details.tbl_business_details_industry,tbl_business_details.tbl_business_details_email,tbl_business_details.tbl_business_details_phone,tbl_business_details.tbl_business_details_district,tbl_business_details.tbl_business_details_town_village,tbl_business_details.tbl_business_details_employees,tbl_business_details.tbl_business_details_investmant_need,tbl_business_details.tbl_business_details_areyouteam,(SELECT COUNT(*) FROM tbl_all_documents WHERE tbl_all_documents.tbl_all_documents_user_id = ' . $id . ' AND tbl_all_documents.tbl_all_documents_type = "B") AS bdoc');
		$this->db->group_by('tbl_business_details.tbl_business_details_user_id');
		$query = $this->db->get('tbl_business_details');
		$result = $query->result();
		return $result;
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

	public function application_details($id)
	{
		$this->db->where('tbl_application.tbl_application_smme_id', $id);
		$this->db->select("SUM(IF(`tbl_application_status`='Applied',20,0)) as a1, SUM(IF(`tbl_application_status`='Approved',40,0)) as a2,SUM(IF(`tbl_application_status`='In Progress',80,0)) as a3,SUM(IF(`tbl_application_status`='Assigned',60,0)) as a4,SUM(IF(`tbl_application_status`='Completed',100,0)) as a5,SUM(IF(`tbl_application_status`='Decline',0,0)) as a6");
		$query = $this->db->get('tbl_application');
		$result = $query->result();

		$this->db->where('tbl_application.tbl_application_smme_id', $id);
		$this->db->select('count(*) as count');
		$query1 = $this->db->get('tbl_application');
		$result1 = $query1->result();
		return array('result' => $result, 'result1' => $result1);
	}

	function __destruct()
	{
		$this->db->close();
	}

	public function select_all_no_row() {

		$this->db->where('tbl_users_role_id','2');
		$this->db->order_by('tbl_users_id','DESC');
		$query=$this->db->get('tbl_users');
		$smme=$query->result();
		$num_rows=$query->num_rows();
		if(!empty($smme))
		{
			$smmeinsertdate = $smme[0]->tbl_users_insertdate;
		}
		else
		{
			$smmeinsertdate = '';
		}

		$this->db->where('tbl_users_role_id','2');
		$this->db->where('tbl_users_status','1');
		$this->db->order_by('tbl_users_id','DESC');
		$querysmmeactive=$this->db->get('tbl_users');
		$smmeactive=$querysmmeactive->num_rows();


		$this->db->where('tbl_users_role_id','3');
		$this->db->order_by('tbl_users_id','DESC');
		$queryinc=$this->db->get('tbl_users');
		$inc=$queryinc->result();
		$num_rows_inc=$queryinc->num_rows();
		if(!empty($inc))
		{
			$incinsertdate = $inc[0]->tbl_users_insertdate;
		}
		else
		{
			$incinsertdate = '';
		}

		$this->db->where('tbl_users_role_id','3');
		$this->db->where('tbl_users_status','1');
		$this->db->order_by('tbl_users_id','DESC');
		$queryincactive=$this->db->get('tbl_users');
		$incactive=$queryincactive->num_rows();

		$this->db->where('tbl_users_role_id','4');
		$this->db->order_by('tbl_users_id','DESC');
		$querybdsp=$this->db->get('tbl_users');
		$bdsp=$querybdsp->result();
		$num_rows_bdsp=$querybdsp->num_rows();

		if(!empty($bdsp))
		{
			$bdspinsertdate = $bdsp[0]->tbl_users_insertdate;
		}
		else
		{
			$bdspinsertdate = '';
		}

		$this->db->where('tbl_users_role_id','4');
		$this->db->where('tbl_users_status','1');
		$this->db->order_by('tbl_users_id','DESC');
		$querybdspactive=$this->db->get('tbl_users');
		$bdspactive=$querybdspactive->num_rows();

		$this->db->order_by('tbl_application_id','DESC');
		$queryapp=$this->db->get('tbl_application');
		$app=$queryapp->result();
		$num_rows_app=$queryapp->num_rows();

		if(!empty($app))
		{
			$appinsertdate = $app[0]->tbl_application_insertdate;
		}
		else
		{
			$appinsertdate = '';
		}

		$this->db->where('tbl_application_status','Applied');
		$this->db->order_by('tbl_application_id','DESC');
		$queryappactive=$this->db->get('tbl_application');
		$appactive=$queryappactive->num_rows();


		return array('smme' => $num_rows,'smme_inserted'=> $smmeinsertdate,'smme_active'=> $smmeactive,'smmedt'=> $smme,'bdsp' => $num_rows_bdsp,'bdsp_inserted'=> $bdspinsertdate,'bdspdt'=> $bdsp,'bdsp_active'=> $bdspactive,'inc' => $num_rows_inc,'inc_inserted'=> $incinsertdate,'incdt'=> $inc,'inc_active'=> $incactive,'app' => $num_rows_app,'app_inserted'=> $appinsertdate,'app_active'=> $appactive);
	}
}
