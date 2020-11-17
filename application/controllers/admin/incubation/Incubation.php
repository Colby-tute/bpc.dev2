<?php

defined('BASEPATH') or exit('No direct script access allowed');


/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Incubation extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata('id_admin'))) {

			$this->session->set_flashdata('flash_data', 'You don\'t have Of Pages');

			redirect('admin/masterlogin');

		}

		$this->load->database();
	}

	public function createStage()
	{
		if ($this->input->server("REQUEST_METHOD") == "POST") {
			$this->db->insert("tbl_stages", $_POST);
			redirect("admin/incubation/Incubation/stages");
		}

		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

		$this->load->view("admin/incubation/createStage", $data);
	}

	public function updateStage($id)
	{
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

		$this->db->select("*");
		$this->db->where("id", $id);
		$data['stage'] = $this->db->get('tbl_stages')->result()[0];

		if ($this->input->server("REQUEST_METHOD") == "POST") {
			$this->db->where("id", $id);
			$this->db->update("tbl_stages", $_POST);
			redirect("admin/incubation/Incubation/stages");
		}

		$this->load->view("admin/incubation/editStage", $data);
	}

	public function deleteStage($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("tbl_stages");
		redirect("admin/incubation/Incubation/stages");
	}

	public function stages()
	{
		$this->db->select("*");
		$data['stages'] = $this->db->get("tbl_stages")->result();

		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

		$this->load->view("admin/incubation/stages", $data);
	}
		
	public function edit($id)
	{
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

		$this->db->select("*");
		$this->db->where("id", $id);
		$query = $this->db->get("tbl_incubation");
		$data['incubation'] = $query->result();

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

			$sql = "UPDATE tbl_incubation SET title=?, description=?, address=?, phone=? WHERE id=?";
			$this->db->query($sql, array($this->input->post('title'), $this->input->post('description'), $this->input->post('address'), $this->input->post('phone'), $id));

			$coaches = $this->input->post("coaches") ? $this->input->post("coaches") : [];
			$incubators = $this->input->post("incubators") ? $this->input->post("incubators") : [];
			$newUsers = array_merge($incubators, $coaches);
			$this->db->select("user_id as id");
			$this->db->where("incubation_id", $id);
			$query = $this->db->get("tbl_incubation_users");
			$oldUsers = $query->result();
			$oldIds = [];
			foreach ($oldUsers as $id) {
				$oldIds[] = $id->id;
			}

			$forDelete = array_diff($oldIds, $newUsers);
			$forSave = array_diff($newUsers, $oldIds);

			if ($forDelete) {
				foreach ($forDelete as $id) {
					$this->db->where("user_id", $id);
					$this->db->where("incubation_id", $data['incubation'][0]->id);
					$this->db->delete('tbl_incubation_users');
				}
			}

			if ($forSave) {
				foreach ($forSave as $id) {
					$this->db->insert("tbl_incubation_users", [
						"user_id" => $id,
						"incubation_id" => $data['incubation'][0]->id
					]);
				}
			}

			return $this->index();
		}

		$this->db->select("user_id");
		$this->db->where("incubation_id", $id);
		$query = $this->db->get("tbl_incubation_users");
		$users = $query->result();

		$data['selectedUsers'] = [];

		foreach ($users as $user) {
			$data['selectedUsers'][] = $user->user_id;
		}

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_role_id", 3);
		$query = $this->db->get("tbl_users");
		$data['incubators'] = $query->result();

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_role_id", 4);
		$query = $this->db->get("tbl_users");
		$data['coaches'] = $query->result();
		$data['id'] = $id;

		$this->load->view('admin/incubation/edit', $data);
	}

	public function index()
	{
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

		$this->db->select("*");
		$query = $this->db->get("tbl_incubation");
		$data['incubations'] = $query->result();

		$this->load->view('admin/incubation/index', $data);
	}

	public function create()
	{
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->db->insert("tbl_incubation", [
				"title" => $this->input->post("title"),
				"description" => $this->input->post("description"),
				"address" => $this->input->post("address"),
				"phone" => $this->input->post("phone")
			]);

			$id = $this->db->insert_id();

			if ($this->input->post("incubators")) {
				foreach ($this->input->post("incubators") as $item) {
					$this->db->insert("tbl_incubation_users", [
						"incubation_id" => $id,
						"user_id" => $item
					]);
				}
			}

			if ($this->input->post("coaches")) {
				foreach ($this->input->post("coaches") as $item) {
					$this->db->insert("tbl_incubation_users", [
						"incubation_id" => $id,
						"user_id" => $item
					]);
				}
			}

			return $this->index();
		}

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_role_id", 3);
		$query = $this->db->get("tbl_users");
		$data['incubators'] = $query->result();

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_role_id", 4);
		$query = $this->db->get("tbl_users");
		$data['coaches'] = $query->result();

		$this->load->view('admin/incubation/create', $data);
	}

	public function delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("tbl_incubation");
		return $this->index();
	}

	public function incubationList()
	{
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

		$this->db->select("*");
		$query = $this->db->get("tbl_incubation");
		$data['incubations'] = $query->result();

		$this->load->view('admin/incubation/incubationList', $data);
	}

	public function incubationDetails($id)
	{
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);

		$this->db->select("*");
		$this->db->where('id',$id);
		$query = $this->db->get("tbl_incubation");
		$data['incubation'] = $query->result()[0];

		$this->db->select('tbl_users.*');
		$this->db->from('tbl_incubation_users');
		$this->db->where('tbl_incubation_users.incubation_id',$id);
		$this->db->join('tbl_users','tbl_incubation_users.user_id=tbl_users.tbl_users_id');
		$query = $this->db->get();
		$incubation_users = $query->result();

		$data['incubators'] = [];
		$data['bdsps'] = [];
		$data['smmes'] = [];
		$data['facility'] = [];

		foreach ($incubation_users as $user) {
			$role = $user->tbl_users_role_id;
			if($role == 2) {
				$data['smmes'][] = $user;
			} else if($role == 3) {
				$data['incubators'][] = $user; 
			} else if($role == 4) {
				$data['bdsps'][] = $user; 
			}
		}

		foreach($data['incubators'] as $icu){
			$this->db->select("bdsp_id, smme_id");
	        $this->db->where("aa.incubator_id", $icu->tbl_users_id);
	        $query = $this->db->get("tbl_application_assignment as aa");
	        $res = $query->result();
	    
	        if ($res) {
	            foreach ($res as $r) {
	                $id = $r->smme_id != null ? $r->smme_id : $r->bdsp_id;
	                $this->db->select("*");
	                $this->db->where("tbl_users_id={$id}");

	                $user = $this->db->get("tbl_users")->result();
	                if($user) {
	                    $user = $user[0];

	                    if ($user->tbl_users_role_id == 2) {
							$dataIds = array_column($data['smmes'],'tbl_users_id');
	                    	if(!in_array($user->tbl_users_id,$dataIds)){
	                    		$data['smmes'][] = $user;
	                    	}
	                        
	                    } 
	                }
	            }
	        }
		}

	    $this->db->select("*");
	    $this->db->from('tbl_facility_items');
	    $this->db->join('tbl_facility_categories','tbl_facility_items.facility_category_id = tbl_facility_categories.facility_category_id');
	    $this->db->where_in('tbl_facility_user_id',array_column($data['incubators'],'tbl_users_id'));

	    $data['facility'] =  $this->db->get()->result();
		$this->load->view('admin/incubation/incubationDetails', $data);
	}
}
