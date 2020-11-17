<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
date_default_timezone_set('Africa/Johannesburg');
class Bdsp extends MY_Controller
{
 
    function __construct() {
        parent::__construct();
 
        if(empty($this->session->userdata('id_user'))) {
            $this->session->set_flashdata('flash_data', 'You don\'t have access!');
            redirect('Login');
        }
        $this->load->model("smme/Bdsp_Modal");
        $this->load->database();
    }
    
    public function index()
    {
        //$result = $this->Bdsp_Modal->select_all_bdsps_data_view();
		
		$sql = "SELECT aa.bdsp_id,u.tbl_users_id, u.tbl_users_firstname, u.tbl_users_lastname,u.tbl_users_contrycode, u.tbl_users_mobile, u.tbl_users_user_uniqueid, u.tbl_users_email FROM tbl_application_assignment aa, tbl_users u WHERE aa.bdsp_id = u.tbl_users_id and aa.bdsp_id is not null and aa.smme_id=".$this->session->userdata("id_user")." GROUP BY u.tbl_users_id"; 
        $Bdsp = $this->db->query($sql)->result(); 
		if(!empty($Bdsp)){
			$data['tdata'] = $Bdsp;
			$result3= array();		
			foreach ($Bdsp as $res){
				$id=$res->tbl_users_id;
				$result2=$this->Bdsp_Modal->select_user_business_data($id);
				if(!empty($result2)){
				foreach($result2 as $res3){
					 $tbl_industry_name3=$res3->tbl_industry_name;
				}
				}else{
					$tbl_industry_name3="";
					
				}
				$result3[] = (object)["tbl_industry_name" => $tbl_industry_name3];
			}
			$data['businessdata']=$result3;
		}else{
			$data['businessdata']=[];
			$data['tdata']=[];			
		}
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $this->load->view('user/smme/bdsps/index',$data);
    }

    public function directory()
    {
        $this->db->select("*");

        $result = $this->Bdsp_Modal->bdsp_directory_get_all();

        $data['tdata'] = $result;

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);

        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

        $this->load->view('user/smme/bdsps/directory', $data);

    }
	
	public function allbdsp()
    {
        $result = $this->Bdsp_Modal->select_all_bdsps_data_view();
		$data['tdata'] = $result;
		
		foreach ($result as $res){
			$id=$res->tbl_users_id;
			$result2=$this->Bdsp_Modal->select_user_business_data($id);
			if(!empty($result2)){
			foreach($result2 as $res3){
				 $tbl_industry_name3=$res3->tbl_industry_name;
			}
			}else{
				$tbl_industry_name3="";
			}
			$result3[] = (object)["tbl_industry_name" => $tbl_industry_name3];
		}
       
 		$data['businessdata']=$result3;
		
        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $this->load->view('user/smme/bdsps/allbdsp',$data);
    }
	

	public function evaluate($id)
	{
		if ($this->input->server("REQUEST_METHOD") == "POST") {
			$this->db->insert("tbl_evaluate_smme_bdsp", $_POST);
			redirect("user/smme/Bdsp");
		}

		$data['header'] = $this->load->view('includes/header', NULL, TRUE);

		$data['footer'] = $this->load->view('includes/footer', NULL, TRUE);

		$data['bdsp_id'] = $id;

		$this->db->select("*");
		$this->db->where("tbl_users_id", $id);
		$data['bdsp'] = $this->db->get("tbl_users")->result();
		$data['bdsp'] = $data['bdsp'][0];

		$this->load->view('user/smme/evaluate', $data);
	}

    public function feedback()
    {
        if ($_POST) {

            $now = date("Y-m-d H:i:s");

            $data = array(
                'tbl_feedback_smme_unique_id' => $this->session->userdata('user_unique_id'),

                'tbl_feedback_user_unique_id' => $this->input->post('user_unique_id'),

                'tbl_feedback_subject' => $this->input->post('subject'),

                'tbl_feedback_feedback' => $this->input->post('bdsp_feedback'),

                'tbl_feedback_insertdate' => $now,

            );

            $result = $this->Bdsp_Modal->feedback($data);
            if ($result == 1) {
                $this->session->set_flashdata("success","Thank you for your Feedback!!!"); 
                redirect('user/smme/Bdsp');
            }else {
                $this->session->set_flashdata("danger","Feedback is not submit!!!"); 
                redirect('user/smme/Bdsp');
            }
        }
    }

    public function view($id) {
          $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/header', NULL, TRUE);
        $personal = $this->Bdsp_Modal->select_user_personal_data($id);

        $data['personal'] = $personal;

      //  $userdt = $this->Bdsp_Modal->select_user_data($id);
        $this->db->join('tbl_stages as s','s.id = u.tbl_users_status','LEFT');
        $this->db->where('tbl_users_id',$id);
        $this->db->select('s.stage,u.*' );
        $query=$this->db->get('tbl_users as u');
        $userdt=$query->result();
		$data['userdt'] = $userdt;
       

        $business = $this->Bdsp_Modal->select_user_business_data($id);
        $data['business'] = $business;

        $smme_teams = $this->Bdsp_Modal->select_smme_teams_data($id);
        $data['smme_teams'] = $smme_teams;

        $this->db->select("*");
        $this->db->where("user_id", $id);
        $data['partners'] = $this->db->get("tbl_user_partner")->result();
		
		 $this->db->where("tbl_all_documents_user_id", $id);
				$this->db->where("tbl_all_documents_type","B");
				$query2 = $this->db->get("tbl_all_documents");
				$businessdoc=$query2->result();
				$data['business_doc']=$businessdoc;       

        $data['header'] = $this->load->view('includes/header', NULL, TRUE);
        $data['footer'] = $this->load->view('includes/footer', NULL, TRUE);
        $this->load->view('user/smme/bdsps/view',$data);
    }
}
