<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Admin_master_model extends CI_Model
{

 
    function __construct() {
        parent::__construct();
        $this->load->database();

    }


    public function insert_master($data) {
        

        $this->db->where("tbl_admins_email='".$data['tbl_admins_email']."' OR tbl_admins_uniqueid='".$data['tbl_admins_uniqueid']."'");

        $duplicate =  $this->db->get('tbl_admins')->row();


        if($duplicate == '')
        {
            $this->db->insert('tbl_admins', $data);
            
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
 
        
    public function select_all_data() {
        $this->db->join('tbl_roles','tbl_roles.tbl_roles_id = tbl_admins.tbl_admins_roleid');
        $query=$this->db->get('tbl_admins');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }

    public function select_all_role()
    { 
        $query=$this->db->get('tbl_roles');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function select_data($i) {
        
        $this->db->where('tbl_admins_id',$i);
        $query=$this->db->get('tbl_admins');
        $result=$query->result();
        $num_rows=$query->num_rows();
        $last_three_record=array_slice($result,-3,3,true);
        return $result;
        
    }
    public function update_master($data,$i) {
       
        $this->db->where("tbl_admins_email='".$data['tbl_admins_email']."' AND tbl_admins_id !='".$i."'");
        $duplicate =  $this->db->get('tbl_admins')->row();

       /* $
        $query = $this->db->get('Persons');*/

        //print_r($duplicate);exit;

        if($duplicate == '')
        {
            //echo "dta";exit;
            //$this->db->insert('master', $data);
            $this->db->where('tbl_admins_id', $i);
            $this->db->update('tbl_admins', $data);
            
            if($this->db->trans_status() == TRUE)
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

    public function did_delete_row($i){
        /*print_r($i);
        print_r($data);exit;*/
        $this->db->where('tbl_admins_id', $i);
        $this->db->delete('tbl_admins');
        
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