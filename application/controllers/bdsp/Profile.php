<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model("Profile_Modal");
		$this->load->database();

	}

	public function edit_profile($id) {

		$editdt = $this->Profile_Modal->select_user_data($id);
		$personal = $this->Profile_Modal->select_user_personal_data($id);
		$identity_doc = $this->Profile_Modal->select_identity_doc($id);
		$education_doc = $this->Profile_Modal->select_education_doc($id);

		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$data['userdt'] = $editdt;
		$data['personal'] = $personal;
		$data['identity_doc'] = $identity_doc;
		$data['education_doc'] = $education_doc;


		$this->load->view('bdsp/edit_profile',$data);
	}

	public function view_profile($id) {

		$editdt = $this->Profile_Modal->select_user_data($id);
		$personal = $this->Profile_Modal->select_user_personal_data($id);
		/*$identity_doc = $this->Profile_Modal->select_identity_doc($id);
		$education_doc = $this->Profile_Modal->select_education_doc($id); */
		$data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$data['userdt'] = $editdt;
		$data['personal'] = $personal;
		/*$data['identity_doc'] = $identity_doc;
		$data['education_doc'] = $education_doc;*/

		$this->load->view('bdsp/view_profile',$data);
	}

	public function update($upd_id) {

		if($_POST)
		{
			$now = date("Y-m-d H:i:s");
			$randomid = mt_rand(100000,999999);
			//echo $randomid;
			$user = array(


				'tbl_users_firstname' => $this->input->post('tbl_users_firstname'),

				'tbl_users_lastname'=> $this->input->post('tbl_users_lastname'),

				'tbl_users_contrycode'=> $this->input->post('country_code'),

				'tbl_users_mobile'=> $this->input->post('tbl_users_mobile'),

				'tbl_users_gender'=> $this->input->post('tbl_users_gender'),

			);
			$personal = array(

				'tbl_personal_details_occupation' => $this->input->post('tbl_personal_details_occupation'),

				'tbl_personal_details_optional_telephone' => $this->input->post('tbl_personal_details_optional_telephone'),

				'tbl_personal_details_howdidyouknow'=> $this->input->post('tbl_personal_details_howdidyouknow'),

				'tbl_personal_details_education'=> $this->input->post('tbl_personal_details_education'),

				'tbl_personal_details_district'=> $this->input->post('tbl_personal_details_district'),

				'tbl_personal_details_town_village'=> $this->input->post('tbl_personal_details_town_village'),

				'tbl_personal_details_postcode'=> $this->input->post('tbl_personal_details_postcode'),

				'tbl_personal_details_dob' => $this->input->post('tbl_personal_details_dob'),

			);

			$result = $this->Profile_Modal->update_master($user,$personal,$upd_id,$this->input->post('tbl_personal_details_id'));
			$user_id = explode('^', $result);
			if($result[0] == 1) {
				if($_FILES['tbl_personal_details_educational_doc']['name'] != "")
				{
					$image_replace = str_replace(" ", "_",$_FILES['tbl_personal_details_educational_doc']['name']);
					$image_name = "edu_doc_photo_".$randomid."_".$image_replace;
					$images = array(
						'tbl_personal_details_educational_doc' => $image_name,
					);
					$this->Profile_Modal->image_insert($images,$upd_id,'tbl_personal_details','tbl_personal_details_user_id');

					if(!empty($_FILES['tbl_personal_details_educational_doc']['name'])){

						$_FILES['file']['name'] = $image_name;
						$_FILES['file']['type'] = $_FILES['tbl_personal_details_educational_doc']['type'];
						$_FILES['file']['tmp_name'] = $_FILES['tbl_personal_details_educational_doc']['tmp_name'];
						$_FILES['file']['error'] = $_FILES['tbl_personal_details_educational_doc']['error'];
						$_FILES['file']['size'] = $_FILES['tbl_personal_details_educational_doc']['size'];

						$config['upload_path'] = 'assets/users';
						$config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';
						$config['max_size'] = '5000';
						$config['client_name'] = $image_name;

						$this->load->library('upload',$config);

						if($this->upload->do_upload('file')){
							$uploadData = $this->upload->data();
							$filename = $uploadData['client_name'];
							$data1['totalFiles'][] = $filename;
						}
					}
				}
				$this->session->set_flashdata('success', 'Data Inserted Successfully!');
				redirect($_SERVER['HTTP_REFERER']);
			}
			if($result == 2) {
				$this->session->set_flashdata('danger', 'Username or Email id is Duplicate!');
				redirect($_SERVER['HTTP_REFERER']);
			}
			elseif($result == 0) {
				$this->session->set_flashdata('danger', 'We are in truble Data Could not Saved!');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function update_profile_image($id) {
		//print_r($_FILES); exit;
		if($_FILES['tbl_users_photo']['name'] != "")
		{
			unlink('assets/users/'.$this->input->post('old_tbl_users_photo'));

			$image_replace = str_replace(" ", "_",$_FILES['tbl_users_photo']['name']);
			$image_name = "users_photo_".$this->session->userdata('user_unique_id')."_".$image_replace;
			$images = array(
				'tbl_users_photo' => $image_name,
			);
			$this->Profile_Modal->image_insert($images,$id,'tbl_users','tbl_users_id');

			$data = [
			  'user_profile_image' => $image_name,
			];
			$this->session->set_userdata($data);
			

			$_FILES['file']['name'] = $image_name;
			$_FILES['file']['type'] = $_FILES['tbl_users_photo']['type'];
			$_FILES['file']['tmp_name'] = $_FILES['tbl_users_photo']['tmp_name'];
			$_FILES['file']['error'] = $_FILES['tbl_users_photo']['error'];
			$_FILES['file']['size'] = $_FILES['tbl_users_photo']['size'];

			$config['upload_path'] = 'assets/users';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|PNG';
			//$config['max_size'] = '5000';
			$config['client_name'] = $image_name;

			$this->load->library('upload',$config);

			if($this->upload->do_upload('file')){
				$uploadData = $this->upload->data();
			}

			$this->session->set_flashdata('success', 'Profile Photo is Successfully Updated!!!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		else{
			$this->session->set_flashdata('danger', 'Profile Photo is Not Updated!!!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function identity_doc($id) {

		/*print_r($_POST);
		print_r($_FILES);exit;*/

		if ($_POST) {

			$now = date("Y-m-d H:i:s");

			$identity_doc = str_replace(" ", "_",$_FILES['identity_doc_files']['name']);
			$identity_doc_new = "identity_document_".$this->session->userdata('user_unique_id')."_".$identity_doc;

			$data = array(

				'tbl_all_documents_user_id' => $id,

				'tbl_all_documents_title' => $this->input->post('identity_doc_title'),

				'tbl_all_documents_document' => $identity_doc_new,

				'tbl_all_documents_type' => 'I',

				'tbl_all_documents_insertdate' => $now,

			);

			$this->Profile_Modal->insert_document($data);

			if(!empty($_FILES['identity_doc_files']['name'])){

				$_FILES['file']['name'] = $identity_doc_new;
				$_FILES['file']['type'] = $_FILES['identity_doc_files']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['identity_doc_files']['tmp_name'];
				$_FILES['file']['error'] = $_FILES['identity_doc_files']['error'];
				$_FILES['file']['size'] = $_FILES['identity_doc_files']['size'];

				$config['upload_path'] = 'assets/users/identity_document';
				$config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';
				$config['client_name'] = $identity_doc_new;

				$this->load->library('upload',$config);

				if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();
				}
			}

			$this->session->set_flashdata('success', 'Indentity document inserted successfully!!!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		else{
			$this->session->set_flashdata('danger', 'Indentity document is not inserted successfully!!!');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function delete_indentity_doc($id) {

		$select_doc = $this->Profile_Modal->select_all_docs($id);

		unlink('assets/users/identity_document/'.$select_doc[0]->tbl_all_documents_document);

		$result = $this->Profile_Modal->delete_indentity_doc($id);

		if ($result == 1) {

			$this->session->set_flashdata("success","Indentity document is deleted successfully!!!");
			redirect($_SERVER['HTTP_REFERER']);
		}
		else{

			$this->session->set_flashdata("danger","Indentity document is not deleted successfully!!!");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function education_doc($id) {

		/*print_r($_POST);
		print_r($_FILES);exit;*/

		if ($_POST) {

			$now = date("Y-m-d H:i:s");

			$education_doc = str_replace(" ", "_",$_FILES['education_doc_files']['name']);
			$education_doc_new = "education_document_".$this->session->userdata('user_unique_id')."_".$education_doc;

			$data = array(

				'tbl_all_documents_user_id' => $id,

				'tbl_all_documents_title' => $this->input->post('education_doc_title'),

				'tbl_all_documents_document' => $education_doc_new,

				'tbl_all_documents_type' => 'E',

				'tbl_all_documents_insertdate' => $now,

			);

			$this->Profile_Modal->insert_document($data);

			if(!empty($_FILES['education_doc_files']['name'])){

				$_FILES['file']['name'] = $education_doc_new;
				$_FILES['file']['type'] = $_FILES['education_doc_files']['type'];
				$_FILES['file']['tmp_name'] = $_FILES['education_doc_files']['tmp_name'];
				$_FILES['file']['error'] = $_FILES['education_doc_files']['error'];
				$_FILES['file']['size'] = $_FILES['education_doc_files']['size'];

				$config['upload_path'] = 'assets/users/education_document';
				$config['allowed_types'] = 'jpg|jpeg|png|tiff|doc|docx|xls|xlsx|ppt|pptx|pdf';
				$config['client_name'] = $education_doc_new;

				$this->load->library('upload',$config);

				if($this->upload->do_upload('file')){
					$uploadData = $this->upload->data();
				}
			}

			$this->session->set_flashdata('success', 'Education document inserted successfully!!!');
			redirect($_SERVER['HTTP_REFERER']);
		}
		else{
			$this->session->set_flashdata('danger', 'Education document is not inserted successfully!!!');
			redirect($_SERVER['HTTP_REFERER']);
		}

	}

	public function delete_education_doc($id) {

		$select_doc = $this->Profile_Modal->select_all_docs($id);

		unlink('assets/users/education_document/'.$select_doc[0]->tbl_all_documents_document);

		$result = $this->Profile_Modal->delete_education_doc($id);

		if ($result == 1) {

			$this->session->set_flashdata("success","Indentity document is deleted successfully!!!");
			redirect($_SERVER['HTTP_REFERER']);
		}
		else{

			$this->session->set_flashdata("danger","Indentity document is not deleted successfully!!!");
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

}
