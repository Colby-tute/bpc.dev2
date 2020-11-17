<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');
class Team extends MY_Controller
{
 
    function __construct() {
        parent::__construct();
 
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("smme/Team_Modal");
        $this->load->model("smme/BusinessDetails_Modal");
        $this->load->database();
    }
    
    public function index()
    {
        $result = $this->Team_Modal->select_all_teams_data_view($this->session->userdata('id_user'));
        $data['tdata'] = $result;
       
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $this->load->view('user/smme/teams/index',$data);
    }
	
	public function delete($id) 
    {
        $this->db->where("tbl_smme_teams_id", $id);
        $this->db->delete("tbl_smme_teams");
        redirect("user/smme/team");
    }
	
	public function add()
    {
        $result = $this->Team_Modal->select_all_teams_data_view($this->session->userdata('id_user'));
        $data['tdata'] = $result;
		
        $data['id_user'] = $this->session->userdata('id_user');
		
		
        $data['bussiness_detail'] = $this->Team_Modal->select_user_business_data($this->session->userdata('id_user'));
       
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $this->load->view('user/smme/teams/add',$data);
    }
	
	public function create()
    {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->db->insert("tbl_smme_teams", $_POST);
            redirect("user/smme/team");
        }
	}
	
	public function update($id)
    {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->db->where("tbl_smme_teams_id", $id);
            $this->db->update("tbl_smme_teams", $_POST);
            redirect("user/smme/team");
        }    
	}
	
	public function edit($id)
    {
        $result = $this->Team_Modal->select_all_teams_data_view($this->session->userdata('id_user'));
        $data['tdata'] = $result;
		
		$personal = $this->Team_Modal->select_user_team_data($id, $this->session->userdata('id_user'));

        $data['edit_data'] = $personal;
		
		$data['id_user'] = $this->session->userdata('id_user');
		$data['tbl_smme_teams_id'] = $id;
		
		
        $data['bussiness_detail'] = $this->BusinessDetails_Modal->select_user_business_data($this->session->userdata('id_user'));
       
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $this->load->view('user/smme/teams/edit',$data);
    }

    public function view($id) {

        $personal = $this->Team_Modal->select_user_personal_data($id);

        $data['personal'] = $personal;

        $userdt = $this->Team_Modal->select_user_data($id);

        $data['userdt'] = $userdt;

        $business = $this->Team_Modal->select_user_business_data($id);
        $data['business'] = $business;

        $smme_teams = $this->Team_Modal->select_smme_teams_data($id);
        $data['smme_teams'] = $smme_teams;

        $this->db->select("*");
        $this->db->where("user_id", $id);
        $data['partners'] = $this->db->get("tbl_user_partner")->result();

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

        $this->load->view('user/smme/teams/view',$data);
    }
}
