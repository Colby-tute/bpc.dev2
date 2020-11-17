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

		if (empty($this->session->userdata('id_admin'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('admin/masterlogin');
		}

	}

	public function index()
	{
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
		$sql = "SELECT * FROM `tbl_users` WHERE (`tbl_users_firstname` LIKE '%".$_GET['key']."%' OR `tbl_users_lastname` LIKE '%".$_GET['key']."%' OR `tbl_users_user_uniqueid` LIKE '%".$_GET['key']."%' OR `tbl_users_mobile` LIKE '%".$_GET['key']."%' OR `tbl_users_email` LIKE '%".$_GET['key']."%') AND `tbl_users_role_id` = 2";

        $data['search'] = $this->db->query($sql)->result(); 
		// print_r($data['search']);;
		// exit;
        $this->load->view('search',$data);
	}


}
