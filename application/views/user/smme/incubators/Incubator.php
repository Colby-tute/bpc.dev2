<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');
class Incubator extends MY_Controller
{
 
    function __construct() {
        parent::__construct();
 
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("smme/Incubator_Modal");
        $this->load->database();
    }
	
	
	public function index()
    {
		
		$sql = "SELECT aa.incubator_id,u.tbl_users_id, u.tbl_users_firstname, u.tbl_users_lastname,u.tbl_users_contrycode, u.tbl_users_mobile, u.tbl_users_user_uniqueid, u.tbl_users_email FROM tbl_application_assignment aa, tbl_users u WHERE aa.incubator_id = u.tbl_users_id and aa.incubator_id is not null and aa.smme_id=".$this->session->userdata("id_user"); 
        $incubator = $this->db->query($sql)->result();     
		
     //   $result = $this->Incubator_Modal->select_all_incubators_data_view();
        $data['tdata'] = $incubator;
       
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $this->load->view('user/smme/incubators/index',$data);
    }
    
    public function allincubators()
    {
        $result = $this->Incubator_Modal->select_all_incubators_data_view();
		$data['tdata'] = $result; 
		foreach( $result as $results){
			$id=$row->tbl_users_id;
			$this->db->join('tbl_industry','tbl_industry.tbl_industry_id = tbl_business_details.tbl_business_details_industry','LEFT');
			$this->db->join('tbl_sub_industry','tbl_sub_industry.tbl_sub_industry_id = tbl_business_details.tbl_business_details_sub_industry','LEFT');
        	$this->db->where('tbl_business_details_user_id',$id);
            $query=$this->db->get('tbl_business_details');
			$result2=$query->result();
			$data['tdata'] = $result2->tbl_industry_name; 
		}
            
		
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $this->load->view('user/smme/incubators/allincubators',$data);
    }
	
	
	
	

	public function evaluateIncubator($id)
	{
		if ($this->input->server("REQUEST_METHOD") == "POST") {
			$this->db->insert("tbl_evaluate_smme_inc", $_POST);
			redirect("user/smme/Incubators");
		}

		$data['header'] = $this->load->view('includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$data['inc_id'] = $id;
		$data['smme_id'] = $this->session->userdata("id_user");

		$this->db->select("tbl_users_id as id, tbl_users_firstname as name, tbl_users_lastname as last_name");
		$this->db->where("tbl_users_id", $id);
		$data['incubator'] = $this->db->get("tbl_users")->result()[0];

		$this->load->view('user/smme/evaluateIncubator', $data);
	}

    public function feedback()
    {
        if ($_POST) {

            $now = date("Y-m-d H:i:s");

            $data = array(
                'tbl_feedback_smme_unique_id' => $this->session->userdata('user_unique_id'),

                'tbl_feedback_user_unique_id' => $this->input->post('user_unique_id'),

                'tbl_feedback_subject' => $this->input->post('subject'),

                'tbl_feedback_feedback' => $this->input->post('icn_feedback'),

                'tbl_feedback_insertdate' => $now,

            );

            $result = $this->Incubator_Modal->feedback($data);
            if ($result == 1) {
                $this->session->set_flashdata("success","Your feedback was submitted successfully!!!"); 
                redirect('user/smme/Incubators');
            }else {
                $this->session->set_flashdata("danger","There was a problem submitting your feedback!!!"); 
                redirect('user/smme/Incubators');
            }
        }
    }

    public function view($id) {

        $personal = $this->Incubator_Modal->select_user_personal_data($id);

        $data['personal'] = $personal;

        $userdt = $this->Incubator_Modal->select_user_data($id);

        $data['userdt'] = $userdt;

        $business = $this->Incubator_Modal->select_user_business_data($id);
        $data['business'] = $business;

        $smme_teams = $this->Incubator_Modal->select_smme_teams_data($id);
        $data['smme_teams'] = $smme_teams;

        $this->db->select("*");
        $this->db->where("user_id", $id);
        $data['partners'] = $this->db->get("tbl_user_partner")->result();

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

        $this->load->view('user/smme/incubators/view',$data);
    }
}
