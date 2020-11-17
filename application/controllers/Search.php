<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Search extends CI_Controller
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
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$sql = "SELECT aa.bdsp_id,u.tbl_users_id, u.tbl_users_firstname, u.tbl_users_lastname,u.tbl_users_contrycode, u.tbl_users_mobile, u.tbl_users_user_uniqueid, u.tbl_users_email,u.tbl_users_status FROM `tbl_application_assignment` as aa, `tbl_users` as u WHERE aa.smme_id ='".$this->session->userdata("id_user")."' AND aa.bdsp_id = u.tbl_users_id AND (u.tbl_users_firstname like '%".$_GET['key']."%' OR u.tbl_users_lastname like '%".$_GET['key']."%' OR `tbl_users_user_uniqueid` LIKE '%".$_GET['key']."%' OR `tbl_users_mobile` LIKE '%".$_GET['key']."%' OR `tbl_users_email` LIKE '%".$_GET['key']."%') AND u.tbl_users_role_id = 4 AND aa.bdsp_id IS NOT NULL GROUP BY u.tbl_users_id AND aa.smme_id";

        $data['search'] = $this->db->query($sql)->result();
		$this->load->view('user/smme/directory', $data);
	}


}
