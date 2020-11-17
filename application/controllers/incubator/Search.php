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

		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);
        $data['search'] = [];
		$this->db->join('tbl_application','tbl_application.tbl_application_id = tbl_application_assignment.app_id','LEFT');
    	$this->db->select("smme_id as id, app_id, tbl_application.tbl_application_status");
    	$this->db->group_by('smme_id');
		$this->db->where("incubator_id", $this->session->userdata("id_user"));
		$query = $this->db->get('tbl_application_assignment');
		$all = array_unique($query->result(), SORT_REGULAR);
		foreach ($all as $smme) {
			if($smme->tbl_application_status == "Declined" || $smme->tbl_application_status == "")
			{
			}
			else
			{
				$sql = "SELECT * FROM `tbl_users` WHERE `tbl_users_id` = '".$smme->id."' AND `tbl_users_role_id` = 2 AND (tbl_users_firstname like '%".$_GET['key']."%' OR tbl_users_lastname like '%".$_GET['key']."%' OR `tbl_users_user_uniqueid` LIKE '%".$_GET['key']."%' OR `tbl_users_mobile` LIKE '%".$_GET['key']."%' OR `tbl_users_email` LIKE '%".$_GET['key']."%') GROUP BY `tbl_users_id`";
				$user = $this->db->query($sql)->result();

				if(!empty($user)){
					$data['search'][] = $user[0];
				}
			}
		}
        $this->load->view('search',$data);
	}


}