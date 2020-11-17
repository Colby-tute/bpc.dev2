<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name Home.php
 * @author Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg');

class Home extends CI_Controller
{

	function __construct()
	{

		parent::__construct();
		$this->load->database();

		if (empty($this->session->userdata('id_user'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('Login');
		}

		$this->load->model("Home_modal");

	}

	public function index()
	{

		//$datas['user_type'] = 'hel';
		$data['header'] = $this->load->view('includes/header', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$result = $this->Home_modal->get_data($this->session->userdata('id_user'));
		$data['user_data'] = $result;

		$total_count_team = $this->Home_modal->total_count_team($this->session->userdata('id_user'));
		$data['total_count_team'] = $total_count_team['total_rows'];
		$data['smme_team_last_update'] = $total_count_team['result'];

		$application_status = $this->Home_modal->application_status($this->session->userdata('id_user'));
		$data['application_status'] = $application_status;

		$incubators_register_date = $this->Home_modal->incubators_register_date();
		$data['incubators_register_date'] = $incubators_register_date;

		$personal_todos = $this->Home_modal->personal_todo($this->session->userdata('user_unique_id'));
		$data['personal_todos'] = $personal_todos;

		$persoanl_details = $this->Home_modal->persoanl_details($this->session->userdata('id_user'));
		$data['persoanl_details'] = $persoanl_details;

		$business_details = $this->Home_modal->business_details($this->session->userdata('id_user'));
		$data['business_details'] = $business_details;

		$application_details = $this->Home_modal->application_details($this->session->userdata('id_user'));
		$data['application_details'] = $application_details;
		$data['bbmprogress'] = $this->Home_modal->bbmprogress($this->session->userdata('id_user'));
		
		$this->db->select("stage");
		$this->db->join("tbl_stages as s", "s.id=u.tbl_users_status", "LEFT");
		$this->db->where("u.tbl_users_id", $this->session->userdata("id_user"));
		$query = $this->db->get("tbl_users as u");
		
		// Check if application exists
		$this->db->where('tbl_application_smme_id', $this->session->userdata("id_user"));
		$query=$this->db->get('tbl_application');
		$num_rows=$query->num_rows();
		
		if($num_rows == 0)
		{
			$data['stage'] = "No Application";
		}
		else
		{
			$data['stage'] = $query->result()[0]->tbl_application_status;
		}
		//print_r($data['stage']);exit;
		
		$incubators_count = $this->Home_modal->incubators_count1();
		$data['incubators_count'] = $incubators_count;

		$this->load->view('home', $data);
	}

	public function indexbdsp()
	{

		//$datas['user_type'] = 'hel';
		$data['header'] = $this->load->view('includes/headerbdsp', NULL, TRUE);
		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		/*$user_type = $this->session->userdata('user_type');

		$result = $this->Home_modal->check_user($user_type);
		$data['user_type'] = $result;*/

		$result = $this->Home_modal->get_data($this->session->userdata('id_user'));
		$data['user_data'] = $result;

		$total_count_team = $this->Home_modal->total_count_team($this->session->userdata('id_user'));
		$data['total_count_team'] = $total_count_team['total_rows'];
		$data['smme_team_last_update'] = $total_count_team['result'];

		$application_status = $this->Home_modal->application_status($this->session->userdata('id_user'));
		$data['application_status'] = $application_status;

		$incubators_count = $this->Home_modal->incubators_count1();
		$data['incubators_count'] = $incubators_count;
		
		$incubators_register_date = $this->Home_modal->incubators_register_date();
		$data['incubators_register_date'] = $incubators_register_date;

		$personal_todos = $this->Home_modal->personal_todo($this->session->userdata('user_unique_id'));
		$data['personal_todos'] = $personal_todos;

		$persoanl_details = $this->Home_modal->persoanl_details($this->session->userdata('id_user'));
		$data['persoanl_details'] = $persoanl_details;

		$business_details = $this->Home_modal->business_details($this->session->userdata('id_user'));
		$data['business_details'] = $business_details;

		$application_details = $this->Home_modal->application_details($this->session->userdata('id_user'));
		$data['application_details'] = $application_details;

		//print_r($incubators_register_date);exit;

		$this->load->view('home', $data);
	}

	public function login_history()
	{
		$editdt = $this->Home_modal->login_history($this->session->userdata('id_user'));

		$HEADER="";
        $FOOTER="";
        $user_role = $this->session->userdata('user_type');

        if ($user_role == 1) {
            $HEADER="admin/includes/header";
            $FOOTER="admin/includes/footer";
        } elseif ($user_role == 4) {
            $HEADER="bdsp/includes/header";
            $FOOTER="bdsp/includes/footer";
        } elseif ($user_role == 2) {
            $HEADER="includes/header";
            $FOOTER="includes/footer";
        } elseif ($user_role == 3) {
            $HEADER="incubator/includes/header";
            $FOOTER="incubator/includes/footer";
        }

        $data['header'] = $this->load->view($HEADER, NULL, TRUE);
        $data['footer'] = $this->load->view($FOOTER, NULL, TRUE);


		// $data['header'] = $this->load->view('includes/header', NULL, TRUE);
		// $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
		$data['tdata'] = $editdt;

		//$this->load->view ('home', $data);
		$this->load->view('activity_log', $data);
	}

	public function logout()
	{
		$data = ['id_user', 'username', 'user_profile_image', 'user_type', 'user_type_name', 'user_unique_id', 'user_email'];
		$this->session->unset_userdata($data);
		redirect('Login');

	}
}
