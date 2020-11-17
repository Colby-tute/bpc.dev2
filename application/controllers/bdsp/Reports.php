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
		$this->load->model("Home_modal");
		$this->load->database();
	}

	public function index()
	{
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

	/*	$this->db->select("*");
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
		$this->db->where("bdsp_id", $this->session->userdata("id_user"));
		$evaluations = $this->db->get("tbl_evaluate_bdsp_inc")->result();

		if ($evaluations) {
			foreach($evaluations as $e) {
				$this->db->select("*");
				$this->db->where("tbl_users_id", $e->incubator_id);
				$e->user = $this->db->get("tbl_users")->result()[0];
				$data['evaluations'][] = $e;
			}
		}

		$this->load->view('bdsp/reports/index', $data);
	}

	public function create()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$this->db->insert("tbl_reports", $_POST['report']);

			redirect("bdsp/Reports/index", "refresh");
		}

		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

		$this->db->select("*");
		$this->db->where("tbl_users_role_id", 2);
		$query = $this->db->get("tbl_users");
		$data['smmes'] = $query->result();

		$this->load->view('bdsp/reports/create', $data);
	}

	public function view($id)
	{
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

		/*$this->db->select("*");
		$this->db->where("id", $id);
		$query = $this->db->get("tbl_reports");
		$report = $query->result();

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_id", $report[0]->smme_id);
		$query = $this->db->get("tbl_users");
		$user = $query->result();
		$report[0]->user = $user[0];

		$data['report'] = $report[0];*/

		$this->db->select("*");
		$this->db->where("id", $id);
		$data['evaluation'] = $this->db->get("tbl_evaluate_bdsp_inc")->result()[0];

		$this->db->select("*");
		$this->db->where("tbl_users_id", $data['evaluation']->incubator_id);
		$data['user'] = $this->db->get("tbl_users")->result()[0];

		$this->load->view('bdsp/reports/view', $data);
	}

	public function delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("tbl_reports");

		redirect("bdsp/Reports/index", "refresh");
	}

	public function logout()
	{
		$data = ['id_user', 'username', 'user_profile_image', 'user_type', 'user_type_name', 'user_unique_id', 'user_email'];
		$this->session->unset_userdata($data);
		redirect('Login');

	}
}
