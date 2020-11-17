<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Role_model extends CI_Model
{

 
    function __construct() {
        parent::__construct();
        $this->load->database();

    }
 
    public function insert_master($data) {
       
            $this->db->insert('tbl_roles', $data);
            
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
        
        /*$this->db->where('tbl_master_email', $data['email']);
        $this->db->where('tbl_master_password', md5($data['password']));
        $this->db->where('tbl_master_status', $active);
        return $this->db->get('master')->row();*/
        return $error;
        
    }
 
        
    public function select_all_data() {
        //$active = 'active';
        /*$this->db->where('tbl_master_status', $active);
        return $this->db->get('master')->row();*/
        /*$this->db->where('tbl_master_status','active');*/
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_data($i) {
        //$active = 'active';
        /*$this->db->where('tbl_master_status', $active);
        return $this->db->get('master')->row();*/
        $this->db->where('tbl_roles_id',$i);
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function update_master($data) {
     
            //echo "dta";exit;
            //$this->db->insert('master', $data);
            $this->db->where('tbl_roles_id', $data['tbl_roles_id']);
            $this->db->update('tbl_roles', $data);
            
            if($this->db->trans_status() == TRUE)
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

    public function did_delete_row($i,$data){
        /*print_r($i);
        print_r($data);exit;*/
        $this->db->where('tbl_roles_id', $i);
            $this->db->delete('tbl_roles');
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