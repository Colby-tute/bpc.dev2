<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name: Login model
 * @author: Imron Rosdiana
 */

date_default_timezone_set('Africa/Johannesburg'); 

class Home_modal extends CI_Model
{
 
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function profile_image($id) {

        $this->db->where('tbl_admins_id',$id);
        $this->db->select('tbl_admins_image');
        $query=$this->db->get('tbl_admins');
        $result=$query->result();
        return $result;
    }

    public function check_user($user_type) {

        $this->db->where('tbl_roles_id',$user_type);
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
        //print_r($result);exit();
        return $result;
    }

     public function select_all_no_row() {

        $this->db->where('tbl_users_role_id','2');
        $this->db->order_by('tbl_users_id','DESC');
        $query=$this->db->get('tbl_users');
        $smme=$query->result();
        $num_rows=$query->num_rows();
        if(!empty($smme))
        {
            $smmeinsertdate = $smme[0]->tbl_users_insertdate;
        }
        else
        {
            $smmeinsertdate = '';
        }

        $this->db->where('tbl_users_role_id','2');
        $this->db->where('tbl_users_status','1');
        $this->db->order_by('tbl_users_id','DESC');
        $querysmmeactive=$this->db->get('tbl_users');
        $smmeactive=$querysmmeactive->num_rows();


        $this->db->where('tbl_users_role_id','3');
        $this->db->order_by('tbl_users_id','DESC');
        $queryinc=$this->db->get('tbl_users');
        $inc=$queryinc->result();
        $num_rows_inc=$queryinc->num_rows();
        if(!empty($inc))
        {
            $incinsertdate = $inc[0]->tbl_users_insertdate;
        }
        else
        {
            $incinsertdate = '';
        }

        $this->db->where('tbl_users_role_id','3');
        $this->db->where('tbl_users_status','1');
        $this->db->order_by('tbl_users_id','DESC');
        $queryincactive=$this->db->get('tbl_users');
        $incactive=$queryincactive->num_rows();

        $this->db->where('tbl_users_role_id','4');
        $this->db->order_by('tbl_users_id','DESC');
        $querybdsp=$this->db->get('tbl_users');
        $bdsp=$querybdsp->result();
        $num_rows_bdsp=$querybdsp->num_rows();

        if(!empty($bdsp))
        {
            $bdspinsertdate = $bdsp[0]->tbl_users_insertdate;
        }
        else
        {
            $bdspinsertdate = '';
        }

        $this->db->where('tbl_users_role_id','4');
        $this->db->where('tbl_users_status','1');
        $this->db->order_by('tbl_users_id','DESC');
        $querybdspactive=$this->db->get('tbl_users');
        $bdspactive=$querybdspactive->num_rows();

        $this->db->order_by('tbl_application_id','DESC');
        $queryapp=$this->db->get('tbl_application');
        $app=$queryapp->result();
        $num_rows_app=$queryapp->num_rows();

        if(!empty($app))
        {
            $appinsertdate = $app[0]->tbl_application_insertdate;
        }
        else
        {
            $appinsertdate = '';
        }

        $this->db->where('tbl_application_status','Applied');
        $this->db->order_by('tbl_application_id','DESC');
        $queryappactive=$this->db->get('tbl_application');
        $appactive=$queryappactive->num_rows();


        return array('smme' => $num_rows,'smme_inserted'=> $smmeinsertdate,'smme_active'=> $smmeactive,'smmedt'=> $smme,'bdsp' => $num_rows_bdsp,'bdsp_inserted'=> $bdspinsertdate,'bdspdt'=> $bdsp,'bdsp_active'=> $bdspactive,'inc' => $num_rows_inc,'inc_inserted'=> $incinsertdate,'incdt'=> $inc,'inc_active'=> $incactive,'app' => $num_rows_app,'app_inserted'=> $appinsertdate,'app_active'=> $appactive);
    }
    public function select_all_role()
    { 
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function login_history($id)
    {
        $this->db->where('tbl_login_history_admin_id',$id);
        $this->db->order_by('tbl_login_history_id','DESC');
        $query=$this->db->get('tbl_login_history');
        $result=$query->result();
        //print_r($result);exit();
        return $result;
    }

    public function insert_master($data,$id,$oldpass) {
        
        $this->db->where("tbl_admins_id",$id);
        $this->db->where("tbl_admins_password",md5($oldpass));
        $duplicate =  $this->db->get('tbl_admins')->row();


        if($duplicate != '')
        {   
            $this->db->where("tbl_admins_id",$id);
            $this->db->update('tbl_admins', $data);
            
            if($this->db->affected_rows() > 0)
            {
                // Code here after successful insert
                $error = 1; // to the controller
            }
            else
            {
                $error = 0;
            }
           //print_r($error);

        }
        else
        { 
            $error = 2;
        }
        return $error;
        
        
    }
    public function select_admin_data($id) {
        $this->db->join('tbl_roles','tbl_roles.tbl_roles_id = tbl_admins.tbl_admins_roleid');
        $this->db->where('tbl_admins_id',$id);
        $query=$this->db->get('tbl_admins');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
        
    }

     public function image_insert($images,$id,$table,$field_name) {

        $this->db->where($field_name,$id);
        $this->db->update($table, $images);
    }

    public function select_data($i) {
        
        $this->db->where('tbl_admins_id',$i);
        $query=$this->db->get('tbl_admins');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
 
    function __destruct() {
        $this->db->close();
    }
}