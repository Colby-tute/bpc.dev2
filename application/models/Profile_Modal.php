<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 /**
 * @name: Login model
 * @author: Imron Rosdiana
 */
class Profile_Modal extends CI_Model
{

 
    function __construct() {
        parent::__construct();
        $this->load->database();

    }

    public function image_insert($images,$id,$table,$field_name) {

        $this->db->where($field_name,$id);
        $this->db->update($table, $images);
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

    public function select_identity_doc($id) {

        $this->db->where('tbl_all_documents_user_id',$id);
        $this->db->where('tbl_all_documents_type','I');
        $query=$this->db->get('tbl_all_documents');
        $result=$query->result();
        $num_rows=$query->num_rows();
        return $result;
    }

    public function select_education_doc($id) {
        $this->db->where('tbl_all_documents_user_id',$id);
        $this->db->where('tbl_all_documents_type','E');
        $query=$this->db->get('tbl_all_documents');
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

    public function insert_document($data) {

        $this->db->insert('tbl_all_documents', $data);
            
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

    public function select_all_docs($id) {
        $this->db->where('tbl_all_documents_id',$id);
        $query=$this->db->get('tbl_all_documents');
        $result=$query->result();
        return $result;
    }

    public function delete_indentity_doc($id) {
        $this->db->where('tbl_all_documents_id', $id);
        $this->db->delete('tbl_all_documents');
        
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

    public function delete_education_doc($id) {
        $this->db->where('tbl_all_documents_id', $id);
        $this->db->delete('tbl_all_documents');
        
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

    function __destruct() {
        $this->db->close();
    }

}