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
		$sql = "SELECT aa.incubator_id,u.tbl_users_id, u.tbl_users_firstname, u.tbl_users_lastname,u.tbl_users_contrycode, u.tbl_users_mobile, u.tbl_users_user_uniqueid, u.tbl_users_email FROM tbl_application_assignment aa, tbl_users u WHERE aa.incubator_id = u.tbl_users_id and aa.incubator_id is not null and aa.smme_id='".$this->session->userdata("id_user")."' GROUP BY u.tbl_users_id"; 
		$incubator = $this->db->query($sql)->result();

		$data['folders'] = $this->folder->getFolders($incubator,$this->session->userdata("id_user"),TRUE);
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $data['path'] = "user/smme/Repository";
        $data['type'] = "";
        $this->load->view('repository/index',$data);
	}

	public function viewRepository($id){
		if(check_repository_assigned($id) == false)
		{
			$this->session->set_flashdata('danger','Folder is not assigned.');
			return redirect(site_url("user/smme/Repository/index"));
		}
		$data['folder'] = $this->folder->getFolder($id);
		$data['files'] = $this->folder->getFiles($id);
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $data['path'] = "user/smme/Repository";
        $data['type'] = "";
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
