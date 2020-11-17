<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Repository Class
 * @author Manoj Kumawat
 */

date_default_timezone_set('Africa/Johannesburg');

class Repositories extends MY_Controller
{
	function __construct()
	{

		parent::__construct();
		$this->load->database();

		if (empty($this->session->userdata('id_admin'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('Login');
		}
		$this->load->model('Repository_Modal','folder');

	}

	public function index()
	{	
		$data['folders'] = $this->folder->getFolders();
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
        $data['path'] = "admin/Repositories";
        $data['type'] = "admin";
        $this->load->view('repository/index',$data);
	}

	public function viewRepository($id){
		$data['folder'] = $this->folder->getFolder($id);
		$data['files'] = $this->folder->getFiles($id);
		$data['header'] = $this->load->view('admin/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('admin/includes/footer', NULL, TRUE);
        $data['path'] = "admin/Repositories";
        $data['type'] = "admin";
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
