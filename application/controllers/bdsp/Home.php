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
		$this->load->database();
		$this->load->model("Home_modal");

	}

	public function index()
	{

		//$datas['user_type'] = 'hel';
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

		/*$user_type = $this->session->userdata('user_type');

		$result = $this->Home_modal->check_user($user_type);
		$data['user_type'] = $result;*/

		$result = $this->Home_modal->get_data($this->session->userdata('id_user'));
		$data['user_data'] = $result;

		// print_r($data['user_data']);exit();

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

		$role = $this->Home_modal->select_all_no_row();

		$data['role'] = $role;

		$this->db->select("COUNT(*)");
		$this->db->where("bdsp_id", $this->session->userdata("id_user"));
		$query = $this->db->get("tbl_application_assignment");
		$count = $query->result_array();

		$data['assigned_smmes'] = count($count);
		//print_r($incubators_register_date);exit;

		$this->db->select("COUNT(*) as count");
		$this->db->where("tbl_application_bdsp_id", $this->session->userdata("id_user"));
		$data['smmeApps'] = $this->db->get("tbl_application")->result()[0]->count;
		
		
		$this->db->select("COUNT(*) as count");
		$this->db->where("tbl_application_bdsp_id", $this->session->userdata("id_user"));
		$this->db->where("tbl_application_status", "Declined");
		$data['declinedApps'] = $this->db->get("tbl_application")->result()[0]->count;

		$this->db->select("COUNT(*) as count");
		$this->db->where("tbl_application_bdsp_id", $this->session->userdata("id_user"));
		$this->db->where("tbl_application_status", "Incubation");
		$data['incSmmes'] = $this->db->get("tbl_application")->result()[0]->count;

		$data['revenues'] = 0;
		
		$this->db->join("tbl_users u",'u.tbl_users_id = `tbl_application`.`tbl_application_smme_id`','LEFT');
		$this->db->select("COUNT(u.tbl_users_id) as count");
		$this->db->where("tbl_application_bdsp_id", $this->session->userdata("id_user"));
		$this->db->where("u.tbl_users_gender='F'");
		$this->db->where("tbl_application_status", "Incubation");
		$data['graduated'] = $this->db->get("tbl_application")->result()[0]->count;
		
		
		$this->db->join("tbl_users u",'u.tbl_users_id = `tbl_application`.`tbl_application_smme_id`','LEFT');
		$this->db->select("COUNT(u.tbl_users_id) as count");
		$this->db->where("tbl_application_bdsp_id", $this->session->userdata("id_user"));
		$this->db->where("u.tbl_users_gender='M'");
		$this->db->where("tbl_application_status", "Incubation");
		$data['msAchieved'] = $this->db->get("tbl_application")->result()[0]->count;


		$data['jobs'] = $data['smmeApps'];
		$data['inc_revenue'] = 0;

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


		$this->load->view('bdsp/home', $data);
	}

	public function login_history()
	{
		$editdt = $this->Home_modal->login_history($this->session->userdata('id_user'));
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);
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
