<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Login_History_model extends CI_Model
{

 
    function __construct() {
        parent::__construct();
        $this->load->database();

    }
 
   public function select_data_login_history($id,$type)
    {

        $this->db->where('tbl_roles_id', $type);
        $query =  $this->db->get('tbl_roles');
        $result = $query->result();
        if($result[0]->tbl_roles_title == 'admin')
        {
            $adminoruser = 'tbl_login_history_admin_id';
        }
        else
        {
            $adminoruser = 'tbl_login_history_user_id';
        }
        $this->db->select('*');
        $this->db->from('tbl_login_history');
        $this->db->join('tbl_roles','tbl_roles.tbl_roles_id = tbl_login_history.'.$adminoruser);
        $this->db->where($adminoruser,$id);
        $this->db->order_by('tbl_login_history_id','DESC');
        $query=$this->db->get();
        $result=$query->result();
        //print_r($result);
        return $result;
    }

    public function login_history($id)
    {
       /* $this->db->join('tbl_roles','tbl_roles.tbl_roles_id = tbl_login_history.tbl_login_history_user_id','left');*/
        $this->db->join('tbl_admins','tbl_admins.tbl_admins_id = `tbl_login_history`.`tbl_login_history_admin_id`','left');
        
        $this->db->join('tbl_roles','tbl_roles.tbl_roles_id = tbl_admins.tbl_admins_roleid','left');
        $this->db->where('tbl_login_history_admin_id',$id);
         $this->db->group_by('tbl_login_history_id','DESC');
        $query=$this->db->get('tbl_login_history');
        $result=$query->result();
       // print_r($result);exit();
        return $result;
    }

    function __destruct() {
        $this->db->close();
    }

}