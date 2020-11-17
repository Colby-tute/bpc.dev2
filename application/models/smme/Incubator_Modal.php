<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Incubator_Modal extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function select_all_incubators_data_view() {

        $this->db->where('tbl_roles_title', 'INCUBATOR');
        $querys=$this->db->get('tbl_roles');
        $results=$querys->result();

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_users_role_id', $results[0]->tbl_roles_id);
        $this->db->group_by('tbl_users_id');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        //print_r($result);exit;
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    
    public function feedback($data) {
        
        $this->db->insert('tbl_feedback', $data);
            
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
        $this->db->where('tbl_users_id',$id);
        $query=$this->db->get('tbl_users');
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

    function __destruct() {
        $this->db->close();
    }
}