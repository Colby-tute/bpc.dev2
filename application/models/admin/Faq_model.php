<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Faq_model extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function select_all_role()
    { 
        $this->db->where('tbl_roles_id !=','1');
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
     public function insert_master($data) {
        //echo "<pre>";
        //print_r($user);exit;
        $this->db->insert('tbl_faqs', $data);
        if($this->db->affected_rows() > 0)
        {
            $error = 1; // to the controller
        }
        else
        {
            $error = 0;
                
        }
        return $error;   
    }

    public function select_faq_data($id) {
        
        
        $this->db->where('tbl_faqs_id',$id);
        $query=$this->db->get('tbl_faqs');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_all_user_data_view($id) {

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->order_by('tbl_users_id', 'DESC');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_all_faq_view($id) {

        $this->db->join('tbl_roles', '`tbl_roles`.`tbl_roles_id` = tbl_faqs.tbl_faqs_role_type','LEFT');
        if($id != '')
        {
           $this->db->where("tbl_faqs_admin_id ='".$id."'");
        }
        $query=$this->db->get('tbl_faqs');
        $result = $query->result();

        //print_r($result);
        return $result;
        
    }
   

    public function update_master($data,$upd_id) {


            $this->db->where("tbl_faqs_id ='".$upd_id."'");
            $this->db->update('tbl_faqs', $data);

            if($this->db->trans_status() == TRUE)
            {
                $error = 1; // to the controller
            }
            else
            {
                $error = 0;
                
            }
        return $error;
    }

    public function did_delete_company_row($i)
    {
        /*print_r($i);
        print_r($data);exit;*/
        $this->db->where('tbl_faqs_id', $i);
            $this->db->delete('tbl_faqs');
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

    

    function __destruct() {
        $this->db->close();
    }
}