<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Calendar_model extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
   

    public function select_all_role()
    { 
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
     public function insert_master($user) {
        
            $this->db->insert('tbl_calender', $user);

            if($this->db->affected_rows() > 0)
            {
               // echo "dhdjh";exit;
                $error = 1; // to the controller
            }
            else
            {
                $error = 0;
                
            }
           //print_r($error);
        return $error;    
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
    public function select_all_smme_data_view() {


        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_users_role_id','2');
        $this->db->group_by('tbl_users_id');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_all_bdsps_data_view() {

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_users_role_id','4');
        $this->db->group_by('tbl_users_id');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        //print_r($result);exit;
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_all_incubators_data_view() {

        $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
        $this->db->where('tbl_users_role_id', '3');
        $this->db->group_by('tbl_users_id');
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        //print_r($result);exit;
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_calender_data($id)
    {
        $this->db->where('tbl_calender_id',$id);
        $query=$this->db->get('tbl_calender');
        $result=$query->result();
        return $result;
    }
    public function update_master($user,$upd_id) {

      

            $this->db->where("tbl_calender_id ='".$upd_id."'");
            $this->db->update('tbl_calender', $user);

            if($this->db->trans_status() == TRUE)
            {
                
               // echo "dhdjh";exit;
                $error = 1; // to the controller
            }
            else
            {
                $error = 0;
                
            }
        return $error."^".$upd_id; 
    }

   

    public function did_delete_company_row($i)
    {
        /*print_r($i);
        print_r($data);exit;*/
        $this->db->where('tbl_users_id', $i);
            $this->db->delete('tbl_users');
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

    public function get_events($start, $end)
    {
        if($start != '' && $end != '')
        {
            return $this->db->where("start >=", $start."%")->where("end <=", $end."%")->get("tbl_calender");
        }
        else
        {
            return $this->db->get("tbl_calender");
        }
    }

    public function add_event($data)
    {
        $this->db->insert("tbl_calender", $data);
    }

    public function get_event($id)
    {
        return $this->db->where("tbl_calender_id", $id)->get("tbl_calender");
    }

    public function update_event($id, $data)
    {
        $this->db->where("tbl_calender_id", $id)->update("tbl_calender", $data);
    }

    public function delete_event($id)
    {
        $this->db->where("tbl_calender_id", $id)->delete("tbl_calender");
    }

    function __destruct() {
        $this->db->close();
    }
}
