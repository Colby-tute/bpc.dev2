<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Repository Class
 * @author Manoj Kumawat
 */

date_default_timezone_set('Africa/Johannesburg');

class Repository extends MY_Controller
{
	function __construct()
	{

		parent::__construct();
		$this->load->database();

		if (empty($this->session->userdata('id_user'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('Login');
		}
		$this->load->model('Repository_Modal','folder');

	}

	public function index()
	{	
		$this->db->distinct("tbl_application_incubator_id as id");
		$this->db->select("tbl_application_incubator_id as id, incubator_id");
		$this->db->join("tbl_application_assignment as aa", "tbl_application.tbl_application_id=aa.app_id", "LEFT");
		$this->db->where("tbl_application_bdsp_id='{$this->session->userdata('id_user')}'");
		$this->db->where("aa.incubator_id IS NOT NULL");
		$query = $this->db->get("tbl_application");
		$incubator = $query->result();

		$data['folders'] = $this->folder->getFolders($incubator,$this->session->userdata("id_user"),TRUE);
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);
        $data['path'] = "bdsp/Repository";
        $data['type'] = "bdsp";
        $this->load->view('repository/index',$data);
	}

	public function viewRepository($id){
		if(check_repository_assigned($id) == false)
		{
			$this->session->set_flashdata('danger','Folder is not assigned.');
			return redirect(site_url("bdsp/Repository/index"));
		}
		$data['folder'] = $this->folder->getFolder($id);
		$data['files'] = $this->folder->getFiles($id);
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);
        $data['path'] = "bdsp/Repository";
        $data['type'] = "bdsp";
        $this->load->view('repository/view',$data);
	}	


	public function download($id){
		$this->load->helper('download');
		$file = $this->folder->getFile($id);
		$this->load->helper('download');
		$name = $file->tbl_filename;
		$data = file_get_contents('./uploads/repository/'.$file->tbl_filename); 
		force_download($name, $data); 
	}

}
