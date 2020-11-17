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
		$data['folders'] = $this->folder->getFolders($this->session->userdata('id_user'));
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);
        $this->load->view('incubator/repository/index',$data);
	}

	public function createFolder(){
		$result = $this->folder->insert($this->input->post(),"tbl_repository");
		if($result == 1){
			$this->session->set_flashdata("success","Repository created.");	
		}else{
			$this->session->set_flashdata('danger','Failed! Please try again!');
		}

		return redirect(site_url('incubator/Repository/index'));
		
	}

	public function updateFolder(){
		$updateData = ['tbl_folder_name' => $this->input->post('tbl_folder_name')];
		$value = $this->input->post('tbl_id');
		$result = $this->folder->update("tbl_id",$value,$updateData,"tbl_repository");

		if($result == 1){
			$this->session->set_flashdata("success","Repository updated.");	
		}else{
			$this->session->set_flashdata('danger','Failed! Please try again!');
		}

		return redirect(site_url('incubator/Repository/index'));
		
	}


	public function deleteFolder($id){
		$count = $this->db->where('tbl_folder_id',$id)->get('tbl_folder_files')->num_rows();
		if($count > 0){
			$this->session->set_flashdata('danger','Folder contain the files. please remove files and try again.');
		}else{
			$data = ['tbl_id'=>$id];
			$result = $this->folder->delete($data,"tbl_repository");
			if($result == 1){
				$this->session->set_flashdata("success","Repository deleted.");	
			}else{
				$this->session->set_flashdata('danger','Failed! Please try again!');
			}
		}

		return redirect(site_url('incubator/Repository/index'));
	}

	public function viewRepository($id){
		$data['folder'] = $this->folder->getFolder($id);
		$data['files'] = $this->folder->getFiles($id);
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);
        $this->load->view('incubator/repository/view',$data);
	}	

	public function deleteFile($id,$fid){
		$data = ['tbl_id'=>$id];
		$file = $this->folder->getFile($fid);
		$result = $this->folder->delete($data,"tbl_folder_files");
		if($result == 1){
			unlink(FCPATH.'./uploads/repository/'.$file->tbl_filename);

			$this->session->set_flashdata("success","File deleted.");	
		}else{
			$this->session->set_flashdata('danger','Failed! Please try again!');
		}

		return redirect(site_url('incubator/Repository/viewRepository/'.$fid));
	}

	public function uploadFile(){
		$config['upload_path']          = './uploads/repository';
        $config['allowed_types']        = '*';
        $config['max_size']             = 1024;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('tbl_filename'))
        {
                $error = array('error' => $this->upload->display_errors());
                
                $this->session->set_flashdata('file_errors',$error);
        }
        else
        {
        	$data = $this->upload->data();
        	$data = [
        		'tbl_folder_id' => $this->input->post('tbl_folder_id'),
        		'tbl_filename' => $data['file_name'],
        		'tbl_filepath' => $data['full_path']
        	];
        	$this->folder->insert($data,"tbl_folder_files");
            $this->session->set_flashdata('success','File uplodaed');
        }

        return redirect(site_url('incubator/Repository/viewRepository/'.$this->input->post('tbl_folder_id')));
	}

	public function download($id){
		$this->load->helper('download');
		$file = $this->folder->getFile($id);
		$this->load->helper('download');
		$name = $file->tbl_filename;
		$data = file_get_contents('./uploads/repository/'.$file->tbl_filename); 
		force_download($name, $data); 
	}

	public function assignRepository($id){
		$this->db->select("bdsp_id, smme_id");
        $this->db->where("aa.incubator_id", $id);
        $this->db->group_by("smme_id");
        $query = $this->db->get("tbl_application_assignment as aa");
        $res = $query->result();
        $data['smmes'] = [];
        if ($res) {
            foreach ($res as $r) {
                $id = $r->smme_id;
                $this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name ,tbl_users_role_id as role_id");
                $this->db->where("tbl_users_id={$id}");

                $user = $this->db->get("tbl_users")->result();
                if($user) {
                    $user = $user[0];

                    if ($user->role_id == 2) {
                        $data['smmes'][] = $user;
                    } 
                }
            }
        }
        $data['bdsps'] = [];
        $sql = "select DISTINCT bdsp_id from tbl_application_assignment where app_id in 
			(SELECT app_id FROM tbl_application_assignment WHERE incubator_id=". $this->session->userdata("id_user") .
		    ") and bdsp_id is not null";
		$bdsps2 = $this->db->query($sql)->result();
		$all = array_unique($bdsps2, SORT_REGULAR);

		foreach ($all as $bdsp) {
			$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name, tbl_users_role_id as role_id");
			$this->db->where("tbl_users_id", $bdsp->bdsp_id);
			$query = $this->db->get("tbl_users");
			$data['bdsps'][] = $query->row();
		}
		$data['asssigned'] = [];

		$result = $this->folder->getAssignedUser($this->session->userdata('id_user'));
		foreach($result as $item){
			$data['asssigned'][] = $item->tbl_folder_id."|".$item->tbl_user_id."|".$item->tbl_owner_id;
		}
		
		$data['folders'] = $this->folder->getFolders($this->session->userdata('id_user'));
		$data['header'] = $this->load->view('incubator/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('incubator/includes/footer', NULL, TRUE);
        $this->load->view('incubator/repository/assign',$data);
	}

	public function assignRepositorySave(){
		$data = $this->input->post('folders');
		$user = $this->session->userdata("id_user");
		if(count($data) == 0){
			$this->session->set_flashdata('danger','Please select the folder to assign.');
			return redirect(site_url('incubator/Repository/assignRepository/'.$user));
		}

		$this->folder->delete(['tbl_owner_id'=>$this->session->userdata("id_user")],"tbl_repository_users");
		$insertData = [];
		foreach($data as $item){
			$itemData = explode("|",$item);
			$insertData[] = [
				'tbl_folder_id' => $itemData[0],
				'tbl_user_id' => $itemData[1],
				'tbl_owner_id' => $itemData[2] 
			];
		}
		$this->db->insert_batch('tbl_repository_users', $insertData);
		$this->session->set_flashdata('success','Assign updated');
		return redirect(site_url('incubator/Repository/assignRepository/'.$user));
	}
}
