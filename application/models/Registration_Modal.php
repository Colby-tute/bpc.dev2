<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Registration_Modal extends CI_Model
{

 
    function __construct() {
        parent::__construct();
        $this->load->database();

    }
    
    public function Select_Type() {

        $this->db->where('tbl_roles_title !=','admin');
        $this->db->order_by('sort ASC');
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
         return $result;
    }

    public function registration($data) {

        $this->db->where("tbl_users_user_uniqueid ='".$data['tbl_users_user_uniqueid']."'");
        $duplicate =  $this->db->get('tbl_users')->row();

        if($duplicate == '')
        {
            $this->db->where("tbl_users_email ='".$data['tbl_users_email']."'");
            $email_duplicate =  $this->db->get('tbl_users')->row();

            if ($email_duplicate == '') {

                $this->db->where("tbl_users_mobile ='".$data['tbl_users_mobile']."'");
                $phone_duplicate =  $this->db->get('tbl_users')->row();
                
                if ($phone_duplicate == '') {

                    $this->db->insert('tbl_users', $data);
                    $conf_id = $data['tbl_users_conf_id'];
                    //$insertId = $this->db->insert_id();

                    if($this->db->affected_rows() > 0)
                    {
                        $error = 1;
                    }
                    else{
                        $error = 0;
                    }
                }
                else{

                    $error = 2; //Error for Phone Number Duplication
                    $conf_id=0;
                }
            }
            else{

                $error = 2; //Error for Email Duplication
                $conf_id=0;
            }
        
        }
        else
        { 
            $error = 2; // Error for UniqueID Duplication
            $conf_id=0;
        }

        return $error."^".$conf_id;
        
    }

    public function image_insert($images,$id,$table,$field_name) {

        $this->db->where($field_name,$id);
        $this->db->update($table, $images);
    }

    public function confirm_email($id) {

        $this->db->where('tbl_users_conf_id',$id);
        $this->db->update('tbl_users',['email_validation' => '1']);
        if ($this->db->trans_status() == TRUE) {
            
            $this->db->join('tbl_roles', 'tbl_roles.tbl_roles_id = tbl_users.tbl_users_role_id','LEFT');
            $this->db->where('tbl_users_conf_id',$id);
            $query =  $this->db->get('tbl_users')->row();
        }
        else{

            $query = '';
        }
        return $query;
    }

    public function select_all_role()
    { 
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }

    public function select_user_data($id) {
        $this->db->where('tbl_users_id',$id);
        $query=$this->db->get('tbl_users');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
        
    }
    public function select_user_personal_data($id) {
        $this->db->where('tbl_personal_details_user_id',$id);
        $query=$this->db->get('tbl_personal_details');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
        
    }
    public function select_user_business_data($id) {
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

    public function update_master($user,$personal,$upd_id,$persona_id) {

            $this->db->where("tbl_users_id ='".$upd_id."'");
            $this->db->update('tbl_users', $user);

            if($this->db->trans_status() == TRUE)
            {
                
                if($persona_id == '')
                {   
                    $now = date("Y-m-d H:i:s");
                    $personal['tbl_personal_details_user_id'] = $upd_id;
                    $personal['tbl_personal_details_insertdate'] = $now;
                    
                    $this->db->insert('tbl_personal_details', $personal);
                }
                else
                {
                   
                    $this->db->where("tbl_personal_details_id='".$persona_id."'");
                    $this->db->update('tbl_personal_details', $personal);

                }

                $error = 1;
            }
            else
            {
                $error = 0;
                
            }
        return $error."^".$upd_id; 
    }

    public function insert_master($data,$id,$oldpass) {
        
        //print_r($id);exit;
        $this->db->where("tbl_users_id",$id);
        $this->db->where("tbl_users_password",md5($oldpass));
        $duplicate =  $this->db->get('tbl_users')->row();

        if($duplicate != '')
        {
            $this->db->where("tbl_users_id",$id);
            $this->db->update('tbl_users', $data);
            
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

    function __destruct() {
        $this->db->close();
    }

}