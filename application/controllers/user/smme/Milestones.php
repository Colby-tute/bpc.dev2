<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');
class Milestones extends MY_Controller
{

	function __construct() {
		parent::__construct();

		if(empty($this->session->userdata('id_user'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('Login');
		}
		$this->load->database();
	}

	public function index()
	{
		$smme_id = $this->session->userdata("id_user");

		$this->db->select('*');
		$this->db->where('smme_id', $smme_id);
		$this->db->order_by('end_date DESC');
		$query = $this->db->get("tbl_milestone");
		$data['milestones'] = $query->result();

		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$data['smme_id'] = $smme_id;

		$this->load->view('user/smme/milestones/index',$data);
	}
}
