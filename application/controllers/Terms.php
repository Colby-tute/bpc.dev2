<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Terms extends CI_Controller
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

	public function index(){
		$id = $this->session->userdata("id_user");
	    $update = $this->db->where('tbl_users_id',$id)->update("tbl_users",['is_terms_accepted'=>1]);

	    $result = $this->db->where('tbl_users_id',$id)->get('tbl_users')->row('is_terms_accepted');
	    echo $result;
	}

}