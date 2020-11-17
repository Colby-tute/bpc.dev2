<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Reports extends CI_Controller
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
	}

	public function index()
	{
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		/*$this->db->select("*");
		$this->db->where("reporter_id", $this->session->userdata("id_user"));
		$query = $this->db->get("tbl_reports");
		$reports = $query->result();

		foreach ($reports as $report) {
			$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
			$this->db->where("tbl_users_id", $report->smme_id);
			$query = $this->db->get("tbl_users");
			$user = $query->result();

			$report->user = $user[0];
			$data['reports'][] = $report;
		}*/

		$this->db->select("*");
		$this->db->where("incubator_id", $this->session->userdata("id_user"));
		$data['bdsp'] = $this->db->get("tbl_evaluate_bdsp_inc")->result();	

		$this->db->select("*");
		$this->db->where("inc_id", $this->session->userdata("id_user"));
		$data['smme'] = $this->db->get("tbl_evaluate_smme_inc")->result();	

		$evaluations = array_merge($data['smme'], $data['bdsp']);

		if ($evaluations) {
			foreach ($evaluations as $e) {
				$e->role = isset($e->bdsp_id) ? "BDSP" : "MSME";
				$id = isset($e->bdsp_id) ? $e->bdsp_id : $e->smme_id;
				$this->db->select("*");
				$this->db->where("tbl_users_id", $id);
				$e->user = $this->db->get("tbl_users")->result()[0];
				$data['evaluations'][] = $e;
			}
		}

		$this->load->view('incubator/reports/index', $data);
	}

	public function create()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$this->db->insert("tbl_reports", $_POST['report']);

			redirect("incubator/Reports/index", "refresh");
		}

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$this->db->select("*");
		$this->db->where("tbl_users_role_id", 2);
		$query = $this->db->get("tbl_users");
		$data['smmes'] = $query->result();

		$this->load->view('incubator/reports/create', $data);
	}

	public function view($id, $role)
	{
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);

		$questions = [
			"bdsp_inc" => [
				"services" => "Shared services/equipment and office space offered by the Incubator",
				"rel_train" => "Relevant Training / Workshops offered by the Incubator",
				"network" => "Networking opportunities created by the Incubator",
				"responsive" => "Incubator's responsiveness to requests by BDSP / MSME",
				"rel_and_upd" => "Relevant and updated information in Knowledge Bank",
				"prof" => "Professionalism of Incubator's infrastructure and office space",
				"prof_staff" => "Professionalism of Incubator's staff",
			],
			"smme_inc" => [
				"shared_s" => "Shared services/equipment and office space offered by the Incubator",
				"rel_train" => "Relevant Training / Workshops offered by the Incubator",
				"networking" => "Networking opportunities created by the Incubator",
				"inc_resp" => "Incubator's responsiveness to requests by BDSP / MSME",
				"rel_info" => "Relevant and updated information in Knowledge Bank",
				"prof" => "Professionalism of Incubator's infrastructure and office space",
				"prof_staff" => "Professionalism of Incubator's staff",
			],
			"smme_bdsp" => [
				"prob_solv" => "Was the problem solved",
				"prob_solve_timely" => "Was the problem solved timely",
				"advice" => "Was the advice that was received 'value for money'",
				"recommend" => "Would you recommend this BDSP, mentor or coach",
			]
		];

		if ($role == "MSME") {
			$db = "tbl_evaluate_smme_inc";
			$user_filed = "smme_id";
			$data['questions'] = $questions['smme_inc'];
			$data['type'] = 'smme_inc';
		} else {
			$db = "tbl_evaluate_bdsp_inc";
			$user_filed = "bdsp_id";
			$data['questions'] = $questions['bdsp_inc'];
			$data['type'] = 'bdsp_inc';
		}

		$this->db->select("*");
		$this->db->where("id", $id);
		$data['evaluation'] = $this->db->get($db)->result()[0];

		$data['json'] = [];
		foreach ($data['evaluation'] as $key => $value) {
			if (isset($questions[$data['type']][$key])) {
				$data['json'][] = [
					"id" => $key,
					"value" => $value
				];
			}
		}
		$data['json'] = json_encode($data['json']);

		$this->db->select("*");
		$this->db->where("tbl_users_id", $data['evaluation']->$user_filed);
		$data['user'] = $this->db->get("tbl_users")->result()[0];

		$data['role'] = $role;

		$this->load->view('incubator/reports/view', $data);
	}

	public function delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("tbl_reports");

		redirect("incubator/Reports/index", "refresh");
	}

	public function logout()
	{
		$data = ['id_user', 'username', 'user_profile_image', 'user_type', 'user_type_name', 'user_unique_id', 'user_email'];
		$this->session->unset_userdata($data);
		redirect('Login');

	}
}
