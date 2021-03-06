<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');
class Partner extends MY_Controller
{
 
    function __construct() {
        parent::__construct();
 
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("bdsp/Partner_Modal");
        $this->load->model("bdsp/BusinessDetails_Modal");
        $this->load->database();
    }
    
    public function index()
    {
        $result = $this->Partner_Modal->select_all_partners_data_view($this->session->userdata('id_user'));
        $data['tdata'] = $result;
       
        $data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);
        $this->load->view('bdsp/partners/index',$data);
    }
	
	public function delete($id) 
    {
        $this->db->where("id", $id);
        $this->db->delete("tbl_user_partner");
        redirect("bdsp/partner");
    }
	
	public function add()
    {
        $result = $this->Partner_Modal->select_all_partners_data_view($this->session->userdata('id_user'));
        $data['tdata'] = $result;
		
        $data['id_user'] = $this->session->userdata('id_user');
		
		
        $data['bussiness_detail'] = $this->BusinessDetails_Modal->select_user_business_data($this->session->userdata('id_user'));
       
        $data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);
        $this->load->view('bdsp/partners/add',$data);
    }
	
	public function create()
    {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->db->insert("tbl_user_partner", $_POST);
            redirect("bdsp/partner");
        }
	}
	
	public function update($id)
    {
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->db->where("id", $id);
            $this->db->update("tbl_user_partner", $_POST);
            redirect("bdsp/partner");
        }    
	}
	
	public function edit($id)
    {
        $result = $this->Partner_Modal->select_all_partners_data_view($this->session->userdata('id_user'));
        $data['tdata'] = $result;
		
		$personal = $this->Partner_Modal->select_user_partner_data($id, $this->session->userdata('id_user'));

        $data['edit_data'] = $personal;
		
		$data['id_user'] = $this->session->userdata('id_user');
		$data['id'] = $id;
		
		
        $data['bussiness_detail'] = $this->BusinessDetails_Modal->select_user_business_data($this->session->userdata('id_user'));
       
        $data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);
        $this->load->view('bdsp/partners/edit',$data);
    }

    public function view($id) {

        $personal = $this->Partner_Modal->select_user_personal_data($id);

        $data['personal'] = $personal;

        $userdt = $this->Partner_Modal->select_user_data($id);

        $data['userdt'] = $userdt;

        $business = $this->Partner_Modal->select_user_business_data($id);
        $data['business'] = $business;

        $bdsp_partners = $this->Partner_Modal->select_bdsp_partners_data($id);
        $data['bdsp_partners'] = $bdsp_partners;

        $this->db->select("*");
        $this->db->where("user_id", $id);
        $data['partners'] = $this->db->get("tbl_user_partner")->result();

        $data['header'] = $this->load->view('bdsp/includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('bdsp/includes/footer', NULL, TRUE);

        $this->load->view('bdsp/partners/view',$data);
    }
}
