<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
		$this->load->database();
		$this->load->model("Home_modal");

	}

	public function index()
	{
		$role = $this->Home_modal->select_all_no_row();

		$data['role'] = $role;

		$this->db->select("COUNT(*)");
		$this->db->where("bdsp_id", $this->session->userdata("id_user"));
		$query = $this->db->get("tbl_application_assignment");
		$count = $query->result_array();

		$data['assigned_smmes'] = count($count);
		//print_r($incubators_register_date);exit;

		$this->db->select("COUNT(*) as count");
		$this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
		$data['smmeApps'] = $this->db->get("tbl_application")->result()[0]->count;

		$this->db->select("COUNT(*) as count");
		$this->db->join("tbl_incubation_users as ic", "u.tbl_users_id=ic.user_id", "LEFT");
		$this->db->where("u.tbl_users_role_id=2");
		$query = $this->db->get("tbl_users as u");
		$data['incSmmes'] = $query->result()[0]->count;
		
		/* Munjal Code */
		$this->db->select("COUNT(*) as count");
		$this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
		$this->db->where("tbl_application_status", "Declined");
		$data['declinedApps'] = $this->db->get("tbl_application")->result()[0]->count;
		
		$this->db->select("COUNT(*) as count");
		$this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
		$this->db->where("tbl_application_status", "Incubation");
		$data['incSmmes'] = $this->db->get("tbl_application")->result()[0]->count;
		
		
		$this->db->select("COUNT(*) as count");
		$this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
		$this->db->where("tbl_application_status", "Graduated");
		$data['graduated00'] = $this->db->get("tbl_application")->result()[0]->count;

		$data['revenues'] = 0;
		
		$this->db->join("tbl_users u",'u.tbl_users_id = `tbl_application`.`tbl_application_smme_id`','LEFT');
		$this->db->select("COUNT(u.tbl_users_id) as count");
		$this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
		$this->db->where("u.tbl_users_gender='F'");
		$this->db->where("tbl_application_status", "Incubation");
		$data['graduated'] = $this->db->get("tbl_application")->result()[0]->count;
		
		
		$this->db->join("tbl_users u",'u.tbl_users_id = `tbl_application`.`tbl_application_smme_id`','LEFT');
		$this->db->select("COUNT(u.tbl_users_id) as count");
		$this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
		$this->db->where("u.tbl_users_gender='M'");
		$this->db->where("tbl_application_status", "Incubation");
		$data['msAchieved'] = $this->db->get("tbl_application")->result()[0]->count;
		
		$data['revenues'] = 0;

		$this->db->select("COUNT(*) as count");
		$tbl_phase_question = $this->db->get("tbl_phase_question")->result()[0]->count;
		//echo $tbl_phase_question; exit;
		
		$data['jobs'] = $tbl_phase_question * $data['incSmmes'];
		
		$this->db->join("tbl_smme_teams u",'`tbl_application`.`tbl_application_smme_id` = u.tbl_smme_teams_user_id','LEFT');
		$this->db->select("tbl_application_smme_id, COUNT(u.tbl_smme_teams_id) as count_row, COUNT(tbl_application_id) as count_apps");
		$this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
		$this->db->group_by("tbl_application_smme_id");
		$rresult = $this->db->get("tbl_application")->result();
		
		$jobs1 = 0;
		
		foreach($rresult as $row1)
		{
			$jobs1+= ($row1->count_row + 1);
		}
		
		$data['jobs1'] = $jobs1;
		
		
		$this->db->join("tbl_business_details u",'`tbl_application`.`tbl_application_smme_id` = u.tbl_business_details_user_id','LEFT');
		$this->db->select("tbl_business_details_user_id, tbl_business_details_revenue_raised");
		$this->db->where("tbl_application_incubator_id", $this->session->userdata("id_user"));
		$this->db->where("tbl_business_details_revenue_raised is NOT NULL", NULL, FALSE);
		$rresult1 = $this->db->get("tbl_application")->result();
		//echo '<pre>'; print_r($rresult1); exit;
		
		$inc_revenue = 0;
		
		foreach($rresult1 as $row1)
		{
			$inc_revenue+= $row1->tbl_business_details_revenue_raised;
		}
		
		$data['inc_revenue'] = $inc_revenue;

		$this->db->select("
		(
			(
				(
				SUM(prob_solv) + 
				SUM(prob_solve_timely) + 
				SUM(advice) + 
				SUM(recommend)
				) 
				/ COUNT(id)
			) 
		/ 4) as total");
		$data['bdsp_rating'] = $this->db->get("tbl_evaluate_smme_bdsp")->result()[0]->total;

		$this->db->select("
		(
			(
				(
				SUM(shared_s) + 
				SUM(rel_train) + 
				SUM(networking) +
				SUM(inc_resp) + 
				SUM(rel_info) +  
				SUM(prof) + 
				SUM(prof_staff)
				) 
				/ COUNT(id)
			) 
		/ 7) as total");
		$data['inc_rating'] = $this->db->get("tbl_evaluate_smme_inc")->result()[0]->total;

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$result = $this->Home_modal->get_data($this->session->userdata('id_user'));
		$data['user_data'] = $result;

		$total_count_team = $this->Home_modal->total_count_team($this->session->userdata('id_user'));
		$data['total_count_team'] = $total_count_team['total_rows'] + 1;
		$data['smme_team_last_update'] = $total_count_team['result'];

		$application_status = $this->Home_modal->application_status($this->session->userdata('id_user'));
		$data['application_status'] = $application_status;

		$incubators_count = $this->Home_modal->incubators_count();
		$data['incubators_count'] = $incubators_count;

		$incubators_register_date = $this->Home_modal->incubators_register_date();
		$data['incubators_register_date'] = $incubators_register_date;

		$personal_todos = $this->Home_modal->personal_todo($this->session->userdata('user_unique_id'));
		$data['personal_todos'] = $personal_todos;

		$persoanl_details = $this->Home_modal->persoanl_details($this->session->userdata('id_user'));
		$data['persoanl_details'] = $persoanl_details;

		$business_details = $this->Home_modal->business_details($this->session->userdata('id_user'));
		$data['business_details'] = $business_details;

		$application_details = $this->Home_modal->application_details($this->session->userdata('id_user'));
		$data['application_details'] = $application_details;

		$this->db->select("*");
		$this->db->where("incubator_id", $this->session->userdata("id_user"));
		$evaluations = $this->db->get("tbl_evaluate")->result();

		if ($evaluations) {
			foreach ($evaluations as $evaluation) {
				$this->db->select("tbl_users_firstname as name, tbl_users_lastname as last_name");
				$this->db->where("tbl_users_id", $evaluation->user_id);
				//TODO FIX
				$bdsps = $this->db->get("tbl_users")->result_array();
				foreach ($bdsps as $bdsp) {
					$evaluation->bdsp = $bdsp['name'] . " " . $bdsp['last_name'];
					break;
				}

				$this->db->select("tbl_users_firstname as name, tbl_users_lastname as last_name");
				$this->db->where("tbl_users_id", $evaluation->smme_id);
				$smmes = $this->db->get("tbl_users")->result_array	();
				foreach ($smmes as $smme) {
					$evaluation->smme = $smme['name'] . " " . $smme['last_name'];
					break;
				}

				$data['evaluations'][] = $evaluation;
 			}
		}


		$this->db->select("*");
		$this->db->where("incubator_id", $this->session->userdata("id_user"));
		$bdspEvaluations = $this->db->get("tbl_evaluate_bdsp_inc")->result();

		if ($bdspEvaluations) {
			foreach ($bdspEvaluations as $evaluation) {
				$this->db->select("tbl_users_firstname as name, tbl_users_lastname as last_name");
				$this->db->where("tbl_users_id", $evaluation->bdsp_id);
				$bdsp = $this->db->get("tbl_users")->result();
				$evaluation->bdsp = $bdsp[0]->name . " " . $bdsp[0]->last_name;

				$data['bdspEvaluations'][] = $evaluation;
			}
		}

		$this->load->view('incubator/home', $data);
	}

	public function login_history()
	{
		$editdt = $this->Home_modal->login_history($this->session->userdata('id_user'));
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$data['tdata'] = $editdt;

		//$this->load->view ('home', $data);
		$this->load->view('activity_log', $data);
	}

	public function logout()
	{
		$data = ['id_user', 'username', 'user_profile_image', 'user_type', 'user_type_name', 'user_unique_id', 'user_email'];
		$this->session->unset_userdata($data);
		redirect('Login');

	}
}
