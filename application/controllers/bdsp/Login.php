<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("Login_Modal");
		$this->load->database();

	}

	public function index() {
		$this->load->view('bdsp/login');
	}

	public function validate_user() {

		if($_POST) {
			$result = $this->Login_Modal->validate_user($_POST);
			//print_r($result);exit;
			if(!empty($result['logindata'])) {
				$data = [
					'id_user' => $result['logindata']->tbl_users_id,
					'username' => $result['logindata']->tbl_users_firstname.' '.$result['logindata']->tbl_users_lastname,
					'user_type' => $result['logindata']->tbl_users_role_id,
					'user_type_name' => $result['logindata']->tbl_roles_title,
					'user_unique_id' => $result['logindata']->tbl_users_user_uniqueid,
					'user_email' => $result['logindata']->tbl_users_email,
				];
				$result1 = $this->Login_Modal->validate_login_ip($data,$result['error']);
				$this->session->set_userdata($data);

				if($result['error'] == 'Login Successfully')
				{
					$this->session->set_flashdata('success', 'Login Successfull!!!');
					redirect('bdsp/Home');
				}
				else if($result['error'] == 'Password Wrong')
				{
					$this->session->set_flashdata('danger', 'Please Enter Conrrect Password!!!');
					redirect('Login');
				}

			}
			else if($result['error'] == 'Email Wrong')
			{
				$this->session->set_flashdata('danger', 'Please Enter Valid Email Address!!!');
				redirect('Login');
			}
			else
			{
				$this->session->set_flashdata('danger', 'Email Id or Password is wrong!');
				redirect('Login');
			}
		}
	}

}
