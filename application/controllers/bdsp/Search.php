<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Search extends MY_Controller
{

	function __construct()
	{

		parent::__construct();
		$this->load->database();

		if (empty($this->session->userdata('id_user'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('Login');
		}

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
		$data['search'] = [];
		foreach ($all as $smme) {
			$sql = "SELECT * FROM `tbl_users` WHERE `tbl_users_id` = '".$smme->id."' AND `tbl_users_role_id` = 2 AND (tbl_users_firstname like '%".$_GET['key']."%' OR tbl_users_lastname like '%".$_GET['key']."%' OR `tbl_users_user_uniqueid` LIKE '%".$_GET['key']."%' OR `tbl_users_mobile` LIKE '%".$_GET['key']."%' OR `tbl_users_email` LIKE '%".$_GET['key']."%') AND `tbl_users_status` IN(4, 6, 7) GROUP BY `tbl_users_id`";

			$user = $this->db->query($sql)->result();
			if(!empty($user)){
				$data['search'][] = $user[0];
			}
		} 

		
        $this->load->view('search',$data);
	}


}
