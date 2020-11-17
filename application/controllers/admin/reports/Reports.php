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
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
		$data['evaluations'] = [];
	
		$this->db->select("*");
		$bdsp_inc = $this->db->get("tbl_evaluate_bdsp_inc")->result();

		if ($bdsp_inc) {
			foreach ($bdsp_inc as $record) {
				$this->db->select("*");
				$this->db->where("tbl_users_id", $record->bdsp_id);
				if (isset($this->db->get("tbl_users")->result()[0])) {
					$bdsp = $this->db->get("tbl_users")->result()[0];
				} else {
					$bdsp = "";
				}
				

				$this->db->select("*");
				$this->db->where("tbl_users_id", $record->incubator_id);
				if (isset($this->db->get("tbl_users")->result()[0])) {
					$inc = $this->db->get("tbl_users")->result()[0];
				} else {
					$inc = "";
				}
				
				$record->type = "bdsp_inc";
				$record->reporter = $bdsp;
				$record->reported = $inc;
				$data['evaluations']['bdsp_inc'][] = $record;
 			}
		}

		$this->db->select("*");
		$smme_bdsp = $this->db->get("tbl_evaluate_smme_bdsp")->result();

		if ($smme_bdsp) {
			foreach ($smme_bdsp as $record) {
				$this->db->select("*");
				$this->db->where("tbl_users_id", $record->smme_id);
				if (isset($this->db->get("tbl_users")->result()[0])) {
					$smme = $this->db->get("tbl_users")->result()[0];
				} else {
					$smme = "";
				}

				$this->db->select("*");
				$this->db->where("tbl_users_id", $record->bdsp_id);
				if (isset($this->db->get("tbl_users")->result()[0])) {
					$bdsp = $this->db->get("tbl_users")->result()[0];
				} else {
					$bdsp = "";
				}
				
				$record->type = "smme_bdsp";
				$record->reporter = $smme;
				$record->reported = $bdsp;
				$data['evaluations']['smme_bdsp'][] = $record;
 			}
		}

		$this->db->select("*");
		$smme_inc = $this->db->get("tbl_evaluate_smme_inc")->result();

		if ($smme_inc) {
			foreach ($smme_inc as $record) {
				$this->db->select("*");
				$this->db->where("tbl_users_id", $record->smme_id);
				if (isset($this->db->get("tbl_users")->result()[0])) {
					$smme = $this->db->get("tbl_users")->result()[0];
				} else {
					$smme = "";
				}

				$this->db->select("*");
				$this->db->where("tbl_users_id", $record->inc_id);
				if (isset($this->db->get("tbl_users")->result()[0])) {
					$inc = $this->db->get("tbl_users")->result()[0];
				} else {
					$inc = "";
				}
				$record->type = "smme_inc";
				$record->reporter = $smme;
				$record->reported = $inc;
				$data['evaluations']['smme_inc'][] = $record;
 			}
		}


		$this->load->view('admin/reports/index', $data);
	}

	public function edit($id, $type, $reporter, $reported)
	{
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

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

		$db = "";
		if ($type == "bdsp_inc") {
			$db = "tbl_evaluate_bdsp_inc";
		} elseif ($type == "smme_inc") {
			$db = "tbl_evaluate_smme_inc";
		} elseif ($type == "smme_bdsp") {
			$db = "tbl_evaluate_smme_bdsp";
		}

		$this->db->select("*");
		$this->db->where("id", $id);
		$data['model'] = $this->db->get($db)->result()[0];
		$data['questions'] = $questions[$type];

		$data['reporter'] = str_replace("%", " ", $reporter);
		$data['reported'] = str_replace("%", " ", $reported);

		$data['json'] = [];
		foreach ($data['model'] as $key => $value) {
			if (isset($questions[$type][$key])) {
				$data['json'][] = [
					"id" => $key,
					"value" => $value
				];
			}
		}

		$data['json'] = json_encode($data['json']);

		$this->load->view('admin/reports/edit', $data);
	}

	public function delete($id, $type)
	{	
		$this->db->where("id", $id);
		if ($type = "bdsp_inc") {
			$this->db->delete("tbl_evaluate_bdsp_inc");
		} elseif ($type = "smme_inc") {
			$this->db->delete("tbl_evaluate_smme_inc");
		} elseif ($type = "smme_bdsp") {
			$this->db->delete("tbl_evaluate_smme_bdsp");
		}
		redirect("admin/reports/Reports");
	}

}
