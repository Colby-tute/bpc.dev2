<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Application_Modal extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function View_Application() {
        $this->db->join('tbl_users as user_incubator','user_incubator.tbl_users_id = tbl_application.tbl_application_incubator_id','LEFT');
        $this->db->join('tbl_users as user_bdsp','user_bdsp.tbl_users_id = tbl_application.tbl_application_bdsp_id','LEFT');
        $this->db->join('tbl_users as user_smme','user_smme.tbl_users_id = tbl_application.tbl_application_smme_id','LEFT');
        $this->db->select('tbl_application.*,user_incubator.tbl_users_firstname as inc_firstname,user_incubator.tbl_users_lastname as inc_lastname,user_bdsp.tbl_users_firstname as bdsp_firstname,user_bdsp.tbl_users_lastname as bdsp_lastname,user_smme.tbl_users_firstname as smme_firstname,user_smme.tbl_users_lastname as smme_lastname,user_smme.tbl_users_id as smme_id');
        $this->db->order_by('tbl_application_id','desc');
    	$query=$this->db->get('tbl_application');
        $result=$query->result();
        $out = [];
        if ($result) {
            foreach ($result as $r) {
                $this->db->select("stage");
                $this->db->join("tbl_stages", "tbl_users.tbl_users_status=tbl_stages.id", "LEFT");
                $this->db->where("tbl_users_id", $r->smme_id);
                $query = $this->db->get("tbl_users");
                if (isset($query->result()[0])) {
                    $status = $query->result()[0]->stage;
                    $r->user_status = $status;
                    $out[] = $r;
                }
            }    
        }
        return $out;
    }
    public function select_incubator() {
        $this->db->where('tbl_users_role_id','3');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        return $result;
    }
    public function stats_change($id,$data){
        $this->db->where('tbl_application_id',$id);
        $this->db->update('tbl_application',$data);
        if($this->db->affected_rows() > 0)
        {
            // Code here after successful insert
            $error = 1; // to the controller
        }
        else
        {
            $error = 0;
        }
        return $error;
    }
    public function select_bdsp() {
        $this->db->where('tbl_users_role_id','4');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        return $result;
    }
    public function select_smme() {
        $this->db->where('tbl_users_role_id','2');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        return $result;
    }
	public function Insert_Application($data) {
		$this->db->insert('tbl_application', $data);
        $inserted_id = $this->db->insert_id();
        if($this->db->affected_rows() > 0)
        {
            // Code here after successful insert
            $this->db->set('tbl_users_status','3'); //update user status to pending approval
            $this->db->where('tbl_users_id',$data['tbl_application_smme_id']);
            $this->db->update('tbl_users');

            $app_assignment_data = array(
              'app_id' => $inserted_id,
              'smme_id' => $data['tbl_application_smme_id'],
              'incubator_id' => $data['tbl_application_incubator_id'],
              'bdsp_id' => $data['tbl_application_bdsp_id']
            );

            $this->db->insert('tbl_application_assignment', $app_assignment_data);
            $error = 1; // to the controller
        }
        else
        {
            $error = 0;
        }
        return $error;
	}
	public function Edit_Application($id) {
		$this->db->where('tbl_application_id',$id);
		$query=$this->db->get('tbl_application');
        $result=$query->result();
        return $result;
	}    
	public function Update_Application($data,$id) {
		$this->db->where('tbl_application_id',$id);
        $this->db->update('tbl_application',$data);
        if ($this->db->trans_status() == TRUE) {
           $error = 1;
        }
        else{
           $error = 0;
        }
        return $error;
	}
	public function Delete_Application($id) {
		$this->db->where('tbl_application_id', $id);
        $this->db->delete('tbl_application');
        if($this->db->affected_rows() > 0)
        {
            $error = 1; 
        }
        else
        {
            $error = 0;
        }
       return $error;
	}
    public function select_user_personal_data($id) {
        $this->db->where('tbl_personal_details_user_id',$id);
        $query=$this->db->get('tbl_personal_details');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
    }
    public function select_user_data($id) {
        $this->db->join('tbl_stages as s','s.id = u.tbl_users_status','LEFT');
        $this->db->where('tbl_users_id',$id);
        $this->db->select('s.stage,u.*' );
        $query=$this->db->get('tbl_users as u');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
    }
    public function select_user_business_data($id) {
		$this->db->join('tbl_industry','tbl_industry.tbl_industry_id = tbl_business_details.tbl_business_details_industry','LEFT');
        $this->db->join('tbl_sub_industry','tbl_sub_industry.tbl_sub_industry_id = tbl_business_details.tbl_business_details_sub_industry','LEFT');
        $this->db->where('tbl_business_details_user_id',$id);
        $query=$this->db->get('tbl_business_details');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
    }
    public function select_smme_teams_data($id) {
        $this->db->where('tbl_smme_teams_user_id',$id);
        $query=$this->db->get('tbl_smme_teams');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
    }
    public function select_mul_doc_id($id) {
        $this->db->where('tbl_business_document_applicationid',$id);
        $query=$this->db->get('tbl_business_document');
        $result=$query->result();
        return $result;
    }
    public function bdsp_incubator_smme_name($id) {
        $this->db->join('tbl_users as user_incubator','user_incubator.tbl_users_id = tbl_application.tbl_application_incubator_id','LEFT');
        $this->db->join('tbl_users as user_bdsp','user_bdsp.tbl_users_id = tbl_application.tbl_application_bdsp_id','LEFT');
        $this->db->join('tbl_users as user_smme','user_smme.tbl_users_id = tbl_application.tbl_application_smme_id','LEFT');
        $this->db->where('tbl_application_id',$id);
        $this->db->select('tbl_application.*,user_incubator.tbl_users_firstname as inc_firstname,user_incubator.tbl_users_lastname as inc_lastname,user_bdsp.tbl_users_firstname as bdsp_firstname,user_bdsp.tbl_users_lastname as bdsp_lastname,user_smme.tbl_users_firstname as smme_firstname,user_smme.tbl_users_lastname as smme_lastname');
        $query=$this->db->get('tbl_application');
        $result=$query->result();
        return $result;
    }   
    function __destruct() {
        $this->db->close();
    }
}